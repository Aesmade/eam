<?php
    include 'header.php';
?>
    <div class="container">
        <div class="box">
            <div class="box-header">Εγγραφή</div>
            <form action="register.php" class="form-horizontal" id="register-form" method="post">
                <div class="form-group has-feedback has-error">
                    <label for="username" class="control-label col-sm-3">Όνομα χρήστη</label>
                    <div class="col-sm-offset-1 col-sm-8">
                        <input type="text" name="username" id="username" placeholder="Όνομα χρήστη" class="form-control"><span class="glyphicon glyphicon-check form-control-feedback"></span>
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span></div>
                </div>
                <div class="form-group has-feedback has-error">
                    <label for="name" class="control-label col-sm-3">Όνομα</label>
                    <div class="col-sm-offset-1 col-sm-8">
                        <input type="text" name="name" id="name" placeholder="Όνομα" class="form-control"><span class="glyphicon glyphicon-check form-control-feedback"></span>
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span></div>
                </div>
                <div class="form-group has-feedback has-error">
                    <label for="surname" class="control-label col-sm-3">Επώνυμο</label>
                    <div class="col-sm-offset-1 col-sm-8">
                        <input type="text" name="surname" id="surname" placeholder="Επώνυμο" class="form-control"><span class="glyphicon glyphicon-check form-control-feedback"></span>
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span></div>
                </div>
                <div class="form-group has-feedback has-error">
                    <label for="email" class="control-label col-sm-3">E-mail</label>
                    <div class="col-sm-offset-1 col-sm-8">
                        <input type="email" name="email" id="email" placeholder="E-mail" class="form-control"><span class="glyphicon glyphicon-check form-control-feedback"></span>
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span></div>
                </div>
                <div class="form-group has-feedback has-error">
                    <label for="password" class="control-label col-sm-3">Κωδικός</label>
                    <div class="col-sm-offset-1 col-sm-8">
                        <input type="password" name="password" id="password" placeholder="Κωδικός" class="form-control"><span class="glyphicon glyphicon-check form-control-feedback"></span>
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span></div>
                </div>
                <div class="form-group has-feedback has-error">
                    <label for="password2" class="control-label col-sm-3">Επανάληψη κωδικού</label>
                    <div class="col-sm-offset-1 col-sm-8">
                        <input type="password" name="password2" id="password2" placeholder="Επανάληψη κωδικού" class="form-control"><span class="glyphicon glyphicon-check form-control-feedback"></span>
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span></div>
                </div>
                <div id="fill-fields" role="alert" class="alert alert-danger" style="display: none">Συμπληρώστε τα παραπάνω πεδία!</div>
                <div id="invalid-email" role="alert" class="alert alert-danger" style="display: none">Το e-mail δεν έχει σωστή μορφή!</div>
                <div id="passwords-no-match" role="alert" class="alert alert-danger" style="display: none">Οι κωδικοί δεν είναι ίδιοι!</div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-lg">Εγγραφή</button>
                </div>
            </form>
        </div>
    </div>
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

            // each field has a check function and a message if the check fails
            var checks = {
                '#username': hasLengthCheck,
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
                        return str == $('#password').val();
                    },
                    errorMsg: '#passwords-no-match'
                }
            };

            for (chk in checks) {
                var elem = $(chk);
                var par = elem.parent().parent();

                // provide the function called whenever a field value changes
                $(chk).on('input', (function(element, parent, checkObj) {

                    // closure for the elem, par and checks[c] vars
                    return function() {
                        // if the check succeeds, mark the field and hide the error message
                        if (checkObj.isValid(element.val())) {
                            parent.removeClass('has-error');
                            parent.addClass('has-success');
                        } else {
                            parent.removeClass('has-success');
                            parent.addClass('has-error');
                        }
                    };

                })(elem, par, checks[chk]));
            }

            // also check password2 when password changes
            var pass2Elem = $('#password2');
            var pass2Par = pass2Elem.parent().parent();
            $('#password').on('input', function() {
                if (checks['#password2'].isValid(pass2Elem.val())) {
                    pass2Par.removeClass('has-error');
                    pass2Par.addClass('has-success');
                } else {
                    pass2Par.removeClass('has-success');
                    pass2Par.addClass('has-error');
                }
            });

            $('#register-form').submit(function(event) {
                $('.alert.alert-danger').hide();

                for (chk in checks) {
                    if (!checks[chk].isValid($(chk).val())) {
                        $(checks[chk].errorMsg).fadeIn();
                        event.preventDefault();
                    }
                }

            });
        });
    })(jQuery);
    </script>
<?php
    include 'footer.php';
?>
