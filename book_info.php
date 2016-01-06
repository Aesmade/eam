<?php
    include 'header.php';
?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Κεντρική</a></li>
            <li><a href="#">Αναζήτηση</a></li>
            <li><a href="#">Αποτελέσματα</a></li>
            <li><span class="active">Τίτλος βιβλίου</span></li>
        </ol>
        <div class="box">
            <div class="box-header">
                <h2>Τίτλος βιβλίου</h2></div>
            <div class="row">
                <div class="col-sm-9">
                    <div class="flex-container">
                        <div class="text-right" style="width:100px;margin-right:30px"><strong>Γλώσσα</strong></div>
                        <div class="text-left">Αγγλικά</div>
                    </div>
                    <div class="flex-container">
                        <div class="text-right" style="width:100px;margin-right:30px"><strong>Συγγραφείς</strong></div>
                        <div class="text-left"><a href="#">Όνομα Επώνυμο</a> | <a href="#">Όνομα Επώνυμο</a></div>
                    </div>
                    <div class="flex-container">
                        <div class="text-right" style="width:100px;margin-right:30px"><strong>Έτος</strong></div>
                        <div class="text-left">2015</div>
                    </div>
                    <div class="flex-container">
                        <div class="text-right" style="width:100px;margin-right:30px"><strong>Περιγραφή</strong></div>
                        <div class="text-left" style="max-width: 450px">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae voluptatem vel itaque quia, pariatur nihil earum quos minus rerum!</div>
                    </div>
                    <div class="flex-container">
                        <div class="text-right" style="width:100px;margin-right:30px"><strong>Κατηγορίες</strong></div>
                        <div class="text-left"><a href="#">Θετικές επιστήμες</a> | <a href="#">Ιστορία</a></div>
                    </div>
                    <div class="flex-container">
                        <div class="text-right" style="width:100px;margin-right:30px"><strong>ISBN</strong></div>
                        <div class="text-left">12345678</div>
                    </div>
                </div>
                <div class="col-sm-3"><img src="resources/img.gif" style="width: 200px; height: 200px;" alt=""></div>
            </div>
            <div class="spacing-top-large">
                <div><a href="#">Προβολή στο διαδίκτυο</a></div>
                <div><a href="#">Αναζήτηση παρόμοιων βιβλίων</a></div>
                <div><a href="#">Κριτικές του βιβλίου</a></div>
                <div><a href="#">Permalink</a></div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    <div class="box mt-80">
                        <div class="box-header">Διαθεσιμότητα</div>
                        <div class="flex-container space-between spacing-top">
                            <div><a href="#">Βιβλιοθήκη 1, Πανεπιστημίου 123</a></div>
                            <div>15 αντίγραφα</div>
                            <div>
                                <button class="btn btn-primary">Δανεισμός</button>
                            </div>
                        </div>
                        <div class="flex-container space-between spacing-top">
                            <div><a href="#">Βιβλιοθήκη 2, Ούλωφ Πάλμε 99</a></div>
                            <div>1 αντίγραφο</div>
                            <div>
                                <button class="btn btn-primary">Δανεισμός</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3" style="top: 40px">
                    <button class="btn btn-default btn-lg" data-toggle="modal" data-target="#suggest-dlg">Προτείνετε αυτό το βιβλίο</button>
                    <div class="label label-success suggestion-sent" style="display: none">Στάλθηκε με επιτυχία!</div>
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
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>
            </div>
        </div>
    </div>
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
                        $('.suggestion-sent').show();
                        setTimeout(function() {
                            $('.suggestion-sent').fadeOut('slow');
                        }, 2500);
                    }, 500);
                }
            });
        });
    </script>
<?php
    include 'footer.php';
?>