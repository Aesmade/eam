<?php
    include 'include/php/db_connect.php';
    include 'include/php/helpers.php';

    $book = array();

    if (isset($_GET['isbn'])) {
        $book['isbn'] = $_GET['isbn'];
        $types = array('book' => 'Βιβλίο', 'magazine' => 'Περιοδικό', 'article' => 'Άρθρο', 'polymorphic' => 'Πολυμορφικό Περιεχόμενο');

        // Query book basic information
        $query = "SELECT title, description, language, publication_date, type, imgm FROM `Book` where isbn = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $book['isbn']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($book['title'], $book['description'], $book['language'], $book['pub_date'], $book['type'], $book['imgm']);
            $stmt->fetch();
            foreach ($book as $key => $value) {
                $book[$key] = htmlspecialchars($value);
            }
        } else {
            // If book doesn't exist.
            $stmt->free_result();
            $stmt->close();
            $db->close();
            // Redirect to the page not found page.
            header('Location: page_not_found.php');
            exit();
        }
        $stmt->free_result();
        $stmt->close();

        // Query book's authors
        $book['authors'] = array();
        $query = 'SELECT a.name FROM `Book_Authors` as ba, `Author` as a
            WHERE ba.book_isbn = ? and ba.author_id = a.id';
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $book['isbn']);
        $stmt->execute();
        $stmt->bind_result($author);
        while ($stmt->fetch()) {
            array_push($book['authors'], $author);
        }
        $stmt->close();

        // Query book's categories
        $book['categories'] = array();
        $query = 'SELECT c.name FROM `Books_by_Category` as bc, `Category` as c
            WHERE bc.book_isbn = ? and bc.category_id = c.id';
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $book['isbn']);
        $stmt->execute();
        $stmt->bind_result($category);
        while ($stmt->fetch()) {
            array_push($book['categories'], $category);
        }
        $stmt->close();

        // Query which libraries loan the book
        $book['quantities'] = array();
        $query = 'SELECT l.id, l.name, bl.quantity FROM `Library` as l, `Books_at_Libraries` as bl
            WHERE bl.book_isbn = ? and bl.library_id = l.id';
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $book['isbn']);
        $stmt->execute();
        $stmt->bind_result($lib_id, $lib_name, $book_quantity);
        while ($stmt->fetch()) {
            $lib_books = array($lib_id, $lib_name, $book_quantity);
            array_push($book['quantities'], $lib_books);
        }
        $stmt->close();

        // Query how many of the books of each library are loaned currently
        $mysqltime = date ("Y-m-d H:i:s", time());
        $query = "SELECT count(id) FROM `Book_Loans` where book_isbn = ? and library_id = ? and end_date > ?";
        $stmt = $db->prepare($query);
        foreach ($book['quantities'] as &$lib_books) {
            $stmt->bind_param('sis', $book['isbn'], $lib_books[0], $mysqltime);
            $stmt->execute();
            $stmt->bind_result($loaned);
            $stmt->fetch();
            $available = $lib_books[2] - $loaned;
            array_push($lib_books, $available);
        }
        $stmt->close;
    }

    $db->close();

    // include header.php and library.css
    $styles = array("%OTHER_STYLESHEET_1%" => "rel=\"stylesheet\" href=\"styles/book.css\"");
    echo replace_contents('include/php/header.php', $styles);
?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.php">Αρχική</a></li>
            <li><a href="search.php">Αναζήτηση</a></li>
            <li><span class="active"><?php echo $book['title'] ?></span></li>
        </ol>
        <div class="box">
            <div class="box-header">
                <h1 class="title"><?php echo $book['title'] ?></h1>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    <div class="row multiple-rows">
                        <div class="text-right col-sm-3 col-md-2"><strong>Συγγραφείς</strong></div>
                        <div class="col-sm-9 col-md-10">
<?php
    for ($i = 0; $i < count($book['authors']) - 1; $i += 1) {
        echo '<a href="search.php?search-type=author&search-terms=' . $book['authors'][$i] . '&search-in=0&search-for=all">' . $book['authors'][$i] . '</a>' . ' | ';
    }
    echo '<a href="search.php?search-type=author&search-terms=' . $book['authors'][$i] . '&search-in=0&search-for=all">' . $book['authors'][$i] . '</a>';
?>
                        </div>
                    </div>
                    <div class="row multiple-rows">
                        <div class="text-right col-sm-3 col-md-2"><strong>Περιγραφή</strong></div>
                        <div class="col-sm-9 col-md-10"><?php echo $book['description'] ?></div>
                    </div>
                    <div class="row multiple-rows">
                        <div class="text-right col-sm-3 col-md-2"><strong>Δημοσίευση</strong></div>
                        <div class="col-sm-9 col-md-10"><?php echo $book['pub_date'] ?></div>
                    </div>
                    <div class="row multiple-rows">
                        <div class="text-right col-sm-3 col-md-2"><strong>Γλώσσα</strong></div>
                        <div class="col-sm-9 col-md-10"><?php echo $book['language'] ?></div>
                    </div>
                    <div class="row multiple-rows">
                        <div class="text-right col-sm-3 col-md-2"><strong>Κατηγορίες</strong></div>
                        <div class="col-sm-9 col-md-10">
<?php
    for ($i = 0; $i < count($book['categories']) - 1; $i += 1) {
        echo '<a href="#">' . $book['categories'][$i] . '</a>' . ' | ';
    }
    echo '<a href="#">' . $book['categories'][$i] . '</a>';
?>
                        </div>
                    </div>
                    <div class="row multiple-rows">
                        <div class="text-right col-sm-3 col-md-2"><strong>ISBN</strong></div>
                        <div class="col-sm-9 col-md-10"><?php echo $book['isbn'] ?></div>
                    </div>
                    <div class="row multiple-rows">
                        <div class="text-right col-sm-3 col-md-2"><strong>Τύπος</strong></div>
                        <div class="col-sm-9 col-md-10"><?php echo $types[$book['type']] ?></div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <img src="<?php echo $book['imgm'] ?>" style="width: 100%; height: 100%;" alt="">
                    <div class="text-center">
                        <button id="suggest-btn" class="btn btn-default btn-lg" data-toggle="modal" data-target="#suggest-dlg">Προτείνετε το βιβλίο</button>
                    </div>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                    <div class="box-header">Διαθεσιμότητα</div>
<?php
    foreach ($book['quantities'] as $lib_books) {
?>
                        <div class="row multiple-rows vertical-align">
                            <div class="col-sm-6"><a href="library.php?id=<?php echo $lib_books[0]?>"><?php echo $lib_books[1]?></a></div>
                            <div class="col-sm-3">Διαθέσιμα <?php echo $lib_books[3]?> από <?php echo $lib_books[2]?></div>
                            <div class="col-sm-3"><button class="btn <?php
                            if (!isset($_SESSION['user']))
                                echo 'btn-default disabled" data-toggle="tooltip" title="Συνδεθείτε για να ενεργοποιηθεί ο δανεισμός"';
                            else
                                echo 'btn-primary"';
                            ?>>Δανεισμός</button></div>
                        </div>
<?php
    }
?>
                    </div>
                </div>
                <div class="col-sm-3 side-box">
                    <div class="side-box-title">Άλλες Δυνατότητες</div>
                    <ul>
                        <li><a href="<?php echo 'book.php?isbn=' . $book['isbn'] ?>">Permalink</a></li>
                        <li><a href="#">Προβολή στο διαδίκτυο</a></li>
                        <li><a href="#">Παρόμοια βιβλία</a></li>
                        <li><a href="#">Κριτικές</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- .modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="suggest-dlg">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Προτείνετε το βιβλίο</h4>
                </div>
                <form role="form">
                    <div class="modal-body">
                        <div class="form-group has-feedback has-error">
                            <label for="suggest-email">E-mail παραλήπτη *</label>
                            <input type="email" name="suggest-email" id="suggest-email" class="form-control" placeholder="E-mail παραλήπτη">
                            <span class="glyphicon glyphicon-check form-control-feedback"></span>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback has-success">
                            <label for="suggest-title">Τίτλος μηνύματος *</label>
                            <input type="text" name="suggest-title" id="suggest-title" class="form-control" value="Πρόταση για βιβλίο: Τίτλος βιβλίου" placeholder="Τίτλος μηνύματος">
                            <span class="glyphicon glyphicon-check form-control-feedback"></span>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="suggest-msg">Μήνυμα</label>
                            <textarea id="suggest-msg" rows="3" class="form-control" placeholder="Μήνυμα προς αποστολή"></textarea>
                        </div>
                        <div id="suggest-alert" role="alert" class="alert alert-danger" style="display: none">Συμπληρώστε τα παραπάνω πεδία!</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Κλείσιμο</button>
                        <button type="button" class="btn btn-primary" id="suggest-submit">Αποστολή</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->
    <script>
        $(function() {
            var emailPattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
            var email = $('#suggest-email');
            var title = $('#suggest-title');

            email.on('input', function() {
                var parent = email.parent();
                if (email.val().length > 0 && emailPattern.test(email.val())) {
                    parent.removeClass('has-error');
                    parent.addClass('has-success');
                } else {
                    parent.removeClass('has-success');
                    parent.addClass('has-error');
                }
            });

            title.on('input', function() {
                var parent = title.parent();
                if (title.val().length > 0) {
                    parent.removeClass('has-error');
                    parent.addClass('has-success');
                } else {
                    parent.removeClass('has-success');
                    parent.addClass('has-error');
                }
            });

            $('#suggest-submit').click(function() {
                if ($('#suggest-dlg').find('.has-error').length > 0) {
                    $('#suggest-alert').fadeIn();
                } else {
                    $('#suggest-alert').hide();
                    $('#suggest-dlg').modal('hide');
                    setTimeout(function() {
                        $('#suggest-btn').html('Το βιβλίο προτάθηκε');
                        $('#suggest-btn').addClass('btn-success');
                        setTimeout(function() {
                            $('#suggest-btn').html('Προτείνετε το βιβλίο');
                            $('#suggest-btn').removeClass('btn-success');
                        }, 2500);
                    }, 500);
                }
            });

        $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
<?php
    include 'include/php/footer.php';
?>
