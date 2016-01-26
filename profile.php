<?php
    session_start();

    if (!isset($_SESSION['user'])) {
        // Redirect to the access error page.
        header('Location: access_error.php');
        exit();
    }

    include 'include/php/db_connect.php';
    include 'include/php/helpers.php';

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
        <div align="right">
            <select  class="align-size-dropdown">
                <option value="" disabled selected>Κριτήριο Αναζήτησης</option>
                <option value="author">Συγγραφέας</option>
                <option value="title">Τίτλος Βιβλίου</option>
            </select>
            <input type="text" class="form" placeholder="Αναζήτηση...">
            <input type="image" align="center" src="resources/search.png">
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
                    <td class="medium-text"><?php echo $start_date ?></td>
                    <td class="medium-text"><?php echo $end_date ?></td>
                    <td><button id="1" type="button" class="btn btn-success" data-toggle="modal" data-target="#extendModal">Επέκταση</button></td>
                </tr>
                <?php } ?>                
            </table>    
        </div>
        <!-- Δανεισμένα Βιβλία Tab end -->
    </div>

    <script>
        $(function() {
            var from = new Date();
            var to = new Date(from.getTime() + 7 * 24 * 60 * 60 * 1000);

            $('#cal').datepicker({
                minDate: from,
                maxDate: to
            })
        });
        function closeModal() {
            $('#extendModal').modal('hide');
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
                        <td>02/04/2016</td>
                        <td><input type="text" id="cal" class="margin-right" tabindex="-1"><img src="resources/calendar.png"></td>
                    </tr>
                </table>
            </div>
            <div class="margin-top-bott" align="center">
                <button id = "ok" class = "confirm-size-margin-bott margin-right-butt" onclick="closeModal()">Οκ</button>
                <button id = "cancel" class = "confirm-size-margin-bott margin-left-butt" onclick="closeModal()">Άκυρο</button> 
            </div>
          </div>
        </div>
    </div>

<?php
    $stmt->close();
    $db->close();
    include 'include/php/footer.php';
?>
