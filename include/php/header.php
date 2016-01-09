<?php
    // Start a user session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>UOA Library</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/main.css" />
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<?php
    if (isset($_SESSION['user']) and $_SESSION['first_time']) {
?>
    <script>
    $(document).ready(function(){
        var message = "Η εγγραφή σας ήταν επιτυχής!";
        $('[data-toggle="tooltip"]').tooltip({title: message, trigger: 'manual'}).tooltip("show"); 
    });

    $(document).click(function(e) {
       $('[data-toggle="tooltip"]').tooltip("destroy");
    });
    </script>
<?php
    }
    $_SESSION['first_time'] = false;
?>
</head>

<body>
    <div class="container">
        <!-- Header start -->
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Αρχική</a>
                        </li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle">Αναζήτηση</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Απλή αναζήτηση</a></li>
                                <li><a href="#">Προχωρημένη αναζήτηση</a></li>
                                <li><a href="#">Οδηγοί αναζήτησης</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle">Δανεισμός-Παραγγελία<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Κανονισμοί δανεισμού</a></li>
                                <li><a href="#">Διαδανεισμός βιβλίου</a></li>
                                <li><a href="#">Παραγγελία άρθρου</a></li>
                                <li><a href="#">Νέα άρθρα</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle">Βιβλιοθήκες<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Λίστα βιβλιοθηκών</a></li>
                                <li><a href="#">Χάρτης βιβλιοθηκών</a></li>
                                <li><a href="#">Για ΑΜΕΑ</a></li>
                                <li><a href="#">Για βιβλιοθηκονόμους</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle">Επικοινωνία<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Αποστολή e-mail</a></li>
                                <li><a href="#">Ζωντανή επικοινωνία</a></li>
                                <li><a href="#">Ανακοινώσεις</a></li>
                                <li><a href="#">Προσωπικό</a></li>
                                <li><a href="#">Θέσεις εργασίας</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle">Βοήθεια<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Συχνές ερωτήσεις</a></li>
                                <li><a href="#">Οδηγοί χρήσης</a></li>
                                <li><a href="#">Χάρτης σελίδας</a></li>
                                <li><a href="#">Κανονισμός λειτουργίας</a></li>
                                <li><a href="#">Προσβασιμότητα</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
<?php
    if (isset($_SESSION['user'])) {
?>
                        <li>
                            <a  href="profile.php" data-toggle="tooltip" data-placement="bottom">Το Προφίλ μου</a>
                        </li>
                        <li>
                            <a href="signout.php">Αποσύνδεση</a>
                        </li>
<?php
    } else {
?>
                        <li>
                            <a aria-haspopup="true" aria-expanded="false" data-toggle="popover" data-trigger="click" role="button" id="login-btn">Σύνδεση</a>
                            <div class="hide">
                                <form action="login.php" method="post" class="form-horizontal">
                                    <div class="form-group">
                                        <label for="name_inp" class="col-sm-4 control-label">E-mail</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="name" id="name_inp" class="form-control" placeholder="E-mail">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pass_inp" class="col-sm-4 control-label">Κωδικός</label>
                                        <div class="col-sm-8">
                                            <input type="password" name="password" id="pass_inp" class="form-control" placeholder="Κωδικός">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <button type="submit" class="pull-right btn btn-primary">Σύνδεση</button>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="text-right small">
                                        <a href="#">Ξέχασα τον κωδικό μου</a>
                                    </div>
                                </form>
                            </div>
                            <script>
                            (function($) {
                                $(function() {
                                    $('#login-btn').popover({
                                        container: 'body',
                                        placement: 'bottom',
                                        html: true,
                                        content: function() {
                                            return $(this).next().html();
                                        }
                                    });
                                });
                            })(jQuery);
                            </script>
                        </li>
                        <li>
                            <a href="register.php">Εγγραφή</a>
                        </li>
<?php
    }
?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- Header end -->
