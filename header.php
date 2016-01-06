<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styles/main.css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <title>UOA Library</title>
</head>

<body>
    <div class="container">
        <!-- Header start -->
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header"><a href="#" class="navbar-brand">University of Athens</a></div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle">Αναζήτηση<span class="caret"></span></a>
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
<?php
    if (isset($_SESSION['user'])) {
?>
                            <li class="dropdown">
                                <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle">Προφίλ<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Δανεισμένα βιβλία</a></li>
                                    <li><a href="#">Ιστορικό δανεισμών</a></li>
                                    <li><a href="#">Ρυθμίσεις</a></li>
                                </ul>
                            </li>
<?php
    } else {
?>
                                <li>
                                    <a aria-haspopup="true" aria-expanded="false" data-toggle="popover" role="button" data-title="Σύνδεση" class="login-btn">Σύνδεση/Εγγραφή</a>
                                    <div class="hide">
                                        <form action="login.php" method="post" class="form-horizontal">
                                            <div class="form-group">
                                                <label for="name_inp" class="col-sm-4 control-label">Όνομα</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="name" id="name_inp" class="form-control" placeholder="Όνομα">
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
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="" id="">Αυτόματη σύνδεση</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-4 col-sm-8">
                                                    <button type="submit" class="btn btn-default">Σύνδεση</button>
                                                </div>
                                            </div>
                                            <div class="text-right small">
                                                <a href="#">Ξέχασα τον κωδικό μου</a>
                                            </div>
                                            <hr />
                                            <div class="text-right small">
                                                <a href="#">Δημιουργία λογαριασμού</a>
                                            </div>
                                        </form>
                                    </div>
                                    <script>
                                    (function($) {
                                        $(function() {
                                            $('.login-btn').popover({
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
<?php
    }
?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- Header end -->
