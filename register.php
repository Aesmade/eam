<?php
    include 'include/php/config.php';

    // Start a user session
    session_start();
    
    $values = array();
    $errors = array('EMPTY_VALUES_ERROR' => false,
                    'BAD_EMAIL_ERROR' => false,
                    'EMAIL_EXISTS_ERROR' => false,
                    'PASSWORDS_DIFFER_ERROR' => false);

    // Check if the form has been submitted.
    if (isset($_POST['register'])) {
	    foreach ($_POST as $key => $value) {
	        $values[$key] = mysql_real_escape_string($value);
	        if (empty($values[$key])) {
	            $errors['EMPTY_VALUES_ERROR'] = true;
	        }
	    }

        // Check if the email is invalid.
        if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['BAD_EMAIL_ERROR'] = true;
        }

        // Check if the two provided passwords don't match.
        if (!empty($values['password']) and $values['password'] != $values['password2']) {
            $errors['PASSWORDS_DIFFER_ERROR'] = true;
        }

        // Check if the provided email is already being used.
        if (!$errors['BAD_EMAIL_ERROR']) {
            $query = "SELECT * FROM `User` WHERE `email` = '{$values['email']}'";
            $result = mysql_query($query);
            if (mysql_num_rows($result) != 0) {
                $errors['EMAIL_EXISTS_ERROR'] = true;
            }
        }

        // Insert user to the database if there are no errors
        if (!$errors['EMPTY_VALUES_ERROR'] and !$errors['BAD_EMAIL_ERROR'] and
                !$errors['PASSWORDS_DIFFER_ERROR'] and !$errors['EMAIL_EXISTS_ERROR']) {
            $password = md5($values['password']);
            $query = "INSERT INTO `eam`.`User` (`id`, `first_name`, `last_name`, `email`, `password`)
                     VALUES (NULL, '{$values['name']}', '{$values['surname']}', '{$values['email']}', '{$password}');";
            $result = mysql_query($query);

            // Set session variables
            $_SESSION['user'] = mysql_insert_id();
            $_SESSION['first_time'] = true;  // loged in for the first time

            // Redirect to the home page.
            header('Location: index.php');
            exit();
        }
    }
    
    include 'include/php/header.php';
?>
    <div class="container">
        <div class="box" id="register-form-box">
            <form action="register.php" class="form-horizontal" id="register-form" method="post">
                <div class="form-group has-feedback">
                    <label for="name" class="control-label col-sm-4">Όνομα</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" id="name" placeholder="Το όνομα σας" class="form-control danger-tooltip"
                               data-toggle="tooltip" data-placement="right" title="Το όνομα σας;">
                        <span class="glyphicon glyphicon-check form-control-feedback nodisplay"></span>
                        <span class="glyphicon glyphicon-remove form-control-feedback nodisplay"></span></div>
                </div>
                <div class="form-group has-feedback">
                    <label for="surname" class="control-label col-sm-4">Επώνυμο</label>
                    <div class="col-sm-8">
                        <input type="text" name="surname" id="surname" placeholder="Το επώνυμο σας" class="form-control danger-tooltip"
                               data-toggle="tooltip" data-placement="right" title="Το επιθετό σας;">
                        <span class="glyphicon glyphicon-check form-control-feedback nodisplay"></span>
                        <span class="glyphicon glyphicon-remove form-control-feedback nodisplay"></span></div>
                </div>
                <div class="form-group has-feedback">
                    <label for="email" class="control-label col-sm-4">E-mail</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" id="email" placeholder="Το e-mail σας" class="form-control danger-tooltip"
                               data-toggle="tooltip" data-placement="right" title="Το e-mail δεν έχει σωστή μορφή!">
                        <span class="glyphicon glyphicon-check form-control-feedback nodisplay"></span>
                        <span class="glyphicon glyphicon-remove form-control-feedback nodisplay"></span></div>
                </div>
                <div class="form-group has-feedback">
                    <label for="password" class="control-label col-sm-4">Κωδικός</label>
                    <div class="col-sm-8">
                        <input type="password" name="password" id="password" placeholder="Επιλέξτε κωδικό" class="form-control danger-tooltip"
                               data-toggle="tooltip" data-placement="right" title="Εισάγετε τον κωδικό σας!">
                        <span class="glyphicon glyphicon-check form-control-feedback nodisplay"></span>
                        <span class="glyphicon glyphicon-remove form-control-feedback nodisplay"></span></div>
                </div>
                <div class="form-group has-feedback">
                    <label for="password2" class="control-label col-sm-4">Επανάληψη Κωδικού</label>
                    <div class="col-sm-8">
                        <input type="password" name="password2" id="password2" placeholder="Εισάγετε ξανά τον κωδικό" class="form-control danger-tooltip"
                               data-toggle="tooltip" data-placement="right" title="Οι κωδικοί πρέπει να είναι ίδιοι!">
                        <span class="glyphicon glyphicon-check form-control-feedback nodisplay"></span>
                        <span class="glyphicon glyphicon-remove form-control-feedback nodisplay"></span></div>
                </div>
<?php
    $style = ($errors['EMPTY_VALUES_ERROR'] ? "" : "display: none");
    print "<div id=\"fill-fields\" role=\"alert\" class=\"alert alert-danger col-sm-offset-4 col-sm-8\" style=\"$style\"><strong>Σφάλμα!</strong> Συμπληρώστε τα παραπάνω πεδία!</div>\n";
    $style = ($errors['BAD_EMAIL_ERROR'] ? "" : "display: none");
    print "<div id=\"invalid-email\" role=\"alert\" class=\"alert alert-danger col-sm-offset-4 col-sm-8\" style=\"$style\"><strong>Σφάλμα!</strong> Το e-mail δεν έχει σωστή μορφή!</div>\n";
    $style = ($errors['EMAIL_EXISTS_ERROR'] ? "" : "display: none");
    print "<div role=\"alert\" class=\"alert alert-danger col-sm-offset-4 col-sm-8\" style=\"$style\"><strong>Σφάλμα!</strong> Το email χρησιμοποιείται ήδη!</div>\n";
    $style = ($errors['PASSWORDS_DIFFER_ERROR'] ? "" : "display: none");
    print "<div id=\"passwords-no-match\" role=\"alert\" class=\"alert alert-danger col-sm-offset-4 col-sm-8\" style=\"$style\"><strong>Σφάλμα!</strong> Οι κωδικοί δεν είναι ίδιοι!</div>\n";
?>
                <div class="text-right">
                    <input type="submit" name="register" id="submit-button" class="btn btn-primary btn-lg" value="Εγγραφή">
                </div>
            </form>
        </div>
    </div>
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip("hide");
    });
    </script>
    <script>
    (function($) {
        $(function() {
            // check used for most fields
            var hasLengthCheck = {
                isValid: function(str) {
                    return str.length > 0;
                },
                errorMsg: '#fill-fields'
            };
            // each field has a check function
            var checks = {
                '#name': hasLengthCheck,
                '#surname': hasLengthCheck,
                '#email': {
                    isValid: function(str) {
                        return str.length > 0 && /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(str);
                    },
                    errorMsg: '#invalid-email'
                },
                '#password': hasLengthCheck,
                '#password2': {
                    isValid: function(str) {
                        return str.length > 0 && str == $('#password').val();
                    },
                    errorMsg: '#passwords-no-match'
                }
            };

            // function called whenever a field value changes
            function checker(check, displayed) {
                var element = $(check);
                var parent = element.parent().parent();
                var checkObj = checks[check];

                if (checkObj.isValid(element.val())) {
                    if (displayed == true || displayed == null) {
                        element.tooltip("hide");
                        displayed = false;
                    }
                    parent.removeClass('has-error');
                    parent.addClass('has-success');                    
                } else {
                    if (displayed == false || displayed == null) {
                        element.tooltip("show");
                        displayed = true;
                    }
                    parent.removeClass('has-success');
                    parent.addClass('has-error');                    
                }
                return displayed;
            };
            
            var delay = (function(){
                var timer = 0;
                return function(callback, ms){
                    clearTimeout (timer);
                    timer = setTimeout(callback, ms);
                };
            })();

            for (chk in checks) {
                $(chk).on('input', (function(check) {
                    var displayed = null;
                    return function() {
                        delay(function() {
                            displayed = checker(check, displayed);
                            if (check == '#password') $('#password2').trigger('input');
                        }, 200);
                    }
                })(chk));
            }

            $('#register-form').submit(function(event) {
                $('.alert.alert-danger').hide();
                for (chk in checks) {
                    if (checker(chk, null)) {
                        event.preventDefault();
                    }
                }
            });
        });
    })(jQuery);
    </script>
<?php
    include 'include/php/footer.php'
?>