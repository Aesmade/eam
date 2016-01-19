<?php
    // Start a user session
    session_start();

    if (!isset($_SESSION['user'])) {
        $_SESSION['redirect_url'] = $_SERVER['PHP_SELF']; 
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>UOA Library</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/main.css" />
    <link %OTHER_STYLESHEET_1% />
    <link %OTHER_STYLESHEET_2% />

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
        $('#profile').tooltip({title: message, trigger: 'manual'}).tooltip("show"); 
    });

    $(document).click(function(e) {
       $('#profile').tooltip("destroy");
    });
    </script>
<?php
    $_SESSION['first_time'] = false;
    }
    if ($_SESSION['login_error']) {
?>
    <script>
    $(document).ready(function(){
        var message = "Τα στοιχεία σύνδεσης ήταν λανθασμένα!";
        $('#login-btn').removeAttr('data-container');

        $('#login-btn').addClass('danger-tooltip');
        $('#login-btn').tooltip({title: message, trigger: 'manual', animation: false}).tooltip("show"); 
    });

    $(document).on('click', function (e) {
       $('#login-btn').tooltip('destroy');
       $('#login-btn').attr('data-container', 'body');
    });
    </script>
<?php
    }
    $_SESSION['login_error'] = false;
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
                            <a href="profile.php" id="profile" class="danger-tooltip" data-toggle="tooltip" data-placement="bottom">Το Προφίλ μου</a>
                        </li>
                        <li>
                            <a href="logout.php">Αποσύνδεση</a>
                        </li>
<?php
    } else {
?>
                        <li>
                            <a aria-haspopup="true" aria-expanded="false" data-toggle="popover" data-placement="bottom" data-container="body"
                               data-html="true" data-trigger="manual" role="button" id="login-btn">Σύνδεση</a>
                            <div class="hide popover-content" id="popover-content">
                                <form action="login.php" method="post" class="form-horizontal">
                                    <div class="form-group">
                                        <label for="email_inp" class="col-sm-4 control-label">E-mail</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="email" id="email_inp" class="form-control" placeholder="E-mail">
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
                                        content: function() {
                                            return $('#popover-content').html();
                                        }
                                    }).click(function() {
                                        if($(this).hasClass('pop')) {
                                            $(this)
                                                .popover('hide')
                                                .removeClass('pop');
                                        } else {
                                            $(this)
                                                .popover('show')
                                                .addClass('pop');
                                        }
                                    });
                                    $('body').on('click', function (e) {
                                        if ($(e.target).data('toggle') !== 'popover'
                                            && $(e.target).parents('.popover-content').length === 0
                                            && $('#login-btn').hasClass('pop')) { 
                                                $('#login-btn').popover('hide').removeClass('pop');
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
