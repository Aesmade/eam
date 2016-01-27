<?php
    session_start();

    if (!isset($_SESSION['user'])) {
        // Redirect to the access error page.
        header('Location: access_error.php');
        exit();
    }

    include 'include/php/db_connect.php';
    include 'include/php/helpers.php';

    if (isset($_POST['extension'])) {
        $query = 'UPDATE `eam`.`Book_Loans` SET `Book_Loans`.end_date = ? WHERE `Book_Loans`.book_isbn = ?';
        $stmt = $db->prepare($query);
        $todate = date_parse_from_format("d/m/Y", $_POST['returnDate']);
        $todatestr = $todate['year'] . "-" . $todate['month'] . "-" . $todate['day'];
        $stmt->bind_param('ss', $todatestr, $_POST['bookIsbn']);
        $stmt->execute();
        $stmt->close();
    } else if (isset($_POST['returnDate']) && isset($_POST['bookIsbn']) && isset($_POST['library']) && isset($_SESSION['user'])) {
        $query = "INSERT INTO `Book_Loans`(user_id, book_isbn, library_id, start_date, end_date) VALUES(?,?,?,?,?)";
        $stmt = $db->prepare($query);
        $todate = date_parse_from_format("d/m/Y", $_POST['returnDate']);
        $todatestr = $todate['year'] . "-" . $todate['month'] . "-" . $todate['day'];
        $stmt->bind_param('isiss', $_SESSION['user'], $_POST['bookIsbn'], $_POST['library'], date('Y-m-d'), $todatestr);
        $stmt->execute();
        $stmt->close();
    }
                    
    $query = 'SELECT `Book`.isbn, `Book`.title, `Book_Loans`.start_date, `Book_Loans`.end_date FROM `Book`, `Book_Loans`
        WHERE `Book_Loans`.user_id = ? and `Book_Loans`.book_isbn = `Book`.isbn';
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', intval($_SESSION['user']));
    $stmt->execute();
    $stmt->bind_result($isbn, $title, $start_date, $end_date);
    $stmt->store_result();

    // include header.php and library.css
    $styles = array('%OTHER_STYLESHEET_1%' => 'rel="stylesheet" href="styles/profile.css"',
                    '%OTHER_STYLESHEET_2%' => 'rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"');
    echo replace_contents('include/php/header.php', $styles);
    
?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.php">Αρχική</a></li>
            <li><span class="active">Προφίλ</span></li>
        </ol>
        <div style="position: relative;" class="height-scale">
            <div class="row">
                <div class="col-sm-3 col-md-2">
                    <img src="resources/profile.jpg" alt="No content available" class="circle" align="left">
                </div>
                <div id="profile-info-div" class="col-sm-9 col-md-10">
                    <div>
                        <span class="bold">Όνομα:</span>
                        <span>&nbsp;<?php echo $_SESSION['first_name']?></span>
                    </div>
                    <div>
                        <span class="bold">Επώνυμο:</span>
                        <span>&nbsp;<?php echo $_SESSION['last_name']?></span>
                    </div>
                    <div>
                        <span class="bold">E-mail:</span>
                        <span>&nbsp;<?php echo $_SESSION['email']?></span>
                    </div>
                </div>
            </div>
        </div>
        <div align="center"> 
            <button class="profile transparent">Γενικά</button>
            <button class="profile clicked">Δανεισμενα Βιβλία</button>
            <button class="profile transparent">Ιστορικό Δανεισμών</button>
            <button class="profile transparent">Ρυθμίσεις</button>
            <hr class="hr"> 
        </div>
        <!-- Δανεισμένα Βιβλία Tab start -->
        <div id="search-div" class="pull-right">
            <form action="" class="form-inline">
                <div class="form-group">
                    <label for="search-dropdown">Αναζήτηση με</label>
                    <select name="search-type" id="search-dropdown" class="form-control">
                        <option value="title">Τίτλο</option>
                        <option value="contents">Περιεχόμενο</option>
                        <option value="author">Συγγραφέα</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="search-terms">για</label>
                    <input type="text" style="width: 250px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" />
                </div>
                <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> Αναζήτηση</button>
            </form>  
        </div>
        <div style="margin-top: 15px">
            <table class="table alignCells-borderless-top">
                <tr class="bottom-border">
                    <td class="big-text">Τίτλος</td>
                    <td class="big-text">Ημερομηνία Δανεισμού</td>
                    <td class="big-text">Ημερομηνία Επιστροφής</td>
                    <td></td>
                </tr>
                <tr class="spacer"></tr>
                <?php while ($stmt->fetch()) { ?>
                <tr>
                    <td class="medium-text"><?php echo '<a href="book.php?isbn=' . $isbn . '">' . $title . '</a>'; ?></td>
                    <td class="medium-text"><?php
                        $startdate_a = date_parse_from_format("Y-m-d", $start_date);
                        $startdate_s = $startdate_a['day'] . "/" . $startdate_a['month'] . "/" . $startdate_a['year'];
                        echo $startdate_s;
                    ?></td>
                    <td class="medium-text"><?php
                        $enddate_a = date_parse_from_format("Y-m-d", $end_date);
                        $enddate_s = $enddate_a['day'] . "/" . $enddate_a['month'] . "/" . $enddate_a['year'];
                        echo $enddate_s;
                    ?></td>
                    <td><button type="button" class="open-extendModal btn btn-success" data-toggle="modal" data-target="#extendModal"
                        data-isbn="<?php echo $isbn ?>" data-returndate="<?php echo $end_date ?>" data-returndate-f="<?php
                        $enddate_a = date_parse_from_format("Y-m-d", $end_date);
                        $enddate_s = $enddate_a['day'] . "/" . $enddate_a['month'] . "/" . $enddate_a['year'];
                        echo $enddate_s;
                        ?>">Επέκταση</button></td>
                </tr>
                <?php } ?>                
            </table>    
        </div>
        <!-- Δανεισμένα Βιβλία Tab end -->
    </div>

    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $(document).on("click", ".open-extendModal", function () {
            var from = new Date($(this).data('returndate'));
            var to = new Date(from);
            to.setDate(from.getDate() + 7);
 
            $('#cal').datepicker('destroy');
            $('#cal').datepicker({
                dateFormat: "dd/mm/yy",
                minDate: from,
                maxDate: to
            });

            $('.return-date').text($(this).data('returndate-f'));
            $('#book-submit').val($(this).data('isbn'));
        });
 
        function closeModal() {
            $('#extendModal').modal('hide');
        }
        
        function closeModalAndPost() {
            var newDate = $('#cal').datepicker().val();
            if (newDate != "") {
                $('#return-date-submit').val(newDate);
                $('#extension-submit').submit();
            } else {
                alert('Παρακαλώ επιλέξτε ημερομηνία παράτασης');
            }
        }
    </script>

    <div class="modal fade" id="extendModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header confirm-align-background-color" align="center">
                <b>Παράταση Δανεισμού Βιβλίου</b>
            </div>
            <div class="modal-body">
                <p align="center">Η υπηρεσία παράτασης δανεισμού βιβλίου σας δίνει την δυνατότητα να επιστρέψετε το
                    βιβλίο με 7 μέρες καθυστέρηση και μπορεί να χρησιμοποιηθεί μία φορά για κάθε βιβλίο.
                </p>
                <br><br>
                <table class = "table alignCells-borderless-top">
                    <tr>
                        <td><b><u>Ημερομηνία Επιστροφής Βιβλίου</u></b>
                        </td><td><b><u>Νέα Ημερομηνία Επιστροφής Βιβλίου</u></b></td>
                    </tr>
                    <tr>
                        <td class="return-date"></td>
                        <td><input type="text" id="cal" class="margin-right" tabindex="-1"><img src="resources/calendar.png"></td>
                    </tr>
                </table>
            </div>
            <div align="center">
                <form id="extension-submit" action="profile.php" class="form-inline" method="post">
                    <input id="return-date-submit" type="hidden" name="returnDate" value="" />
                    <input id="book-submit" type="hidden" name="bookIsbn" value="" />
                    <input type="hidden" name="extension" value="extension" />
                </form>
                <button id="ok" class="btn btn-success button-margin" onclick="closeModalAndPost()">Επιβεβαίωση</button>
                <button id="cancel" class="btn btn-danger button-margin" onclick="closeModal()">Ακύρωση</button>
            </div>
          </div>
        </div>
    </div>

<?php
    $stmt->close();
    $db->close();
    include 'include/php/footer.php';
?>
