<?php
    include 'include/php/helpers.php';

    // include header.php and contact.css
    $styles = array('%OTHER_STYLESHEET_1%' => 'rel="stylesheet" href="styles/contact.css"');
    echo replace_contents('include/php/header.php', $styles);
?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.php">Αρχική</a></li>
            <li><span class="active">Επικοινωνία</span></li>
        </ol>
        <div class="row">
            <div class="col-sm-7">
                <div id="left-box" class="box">
                    <div class="box-header">Κάντε μας μια ερώτηση</div>
                    <div class="form-group"><label for="titleInput">Τίτλος</label><input type="text" name="titleInput" id="titleInput" class="form-control" placeholder="Τίτλος"></div>
                    <div class="form-group"><label for="infoInput">Περισσότερες πληροφορίες</label><textarea name="infoInput" id="infoInput" rows="6" class="form-control" placeholder="Περισσότερες πληροφορίες"></textarea></div>
                    <div class="form-horizontal" style="margin-top: 30px">
                        <label style="padding-top: 10px; padding-bottom: 10px;">Τα στοιχεία σας</label>
                        <div class="form-group vertical-align">
                            <label class="col-sm-3" for="nameInput">Όνομα</label>
                            <div class="col-sm-9"><input type="text" name="inputText" id="inputText" placeholder="Όνομα" class="form-control"></div>
                        </div>
                        <div class="form-group vertical-align">
                            <label class="col-sm-3" for="nameEmail">E-mail</label>
                            <div class="col-sm-9"><input type="text" name="emailText" id="emailText" placeholder="E-mail" class="form-control"></div>
                        </div>
                    </div>
                    <button type="submit" style="margin-top: 20px" class="pull-right btn-lg btn-primary">Αποστολή ερώτησης</button>
                </div>
            </div>
            <div class="col-sm-5">
                <div id="right-box-top" class="box" style="height: 300px">
                    <div class="box-header">Συχνές ερωτήσεις</div>
                    <ul>
                    <li><a href="#">Πώς μπορώ να αναζητήσω βιβλία;</a></li>
                    <li><a href="#">Σε ποιες βιβλιοθήκες έχω πρόσβαση;</a></li>
                    <li><a href="#">Πώς μπορώ να δανειστώ βιβλία;</a></li>
                    <li><a href="#">Πώς μπορώ να παραγγείλω ένα άρθρο;</a></li>
                    <li><a href="#">Μπορώ να εργαστώ στη βιβλιοθήκη;</a></li>
                    <div id="more-questions-link"><a href="#">Περισσότερες ερωτήσεις - Βοήθεια</a></div>
                </div>
                <div id="right-box-bottom" class="box">
                    <div class="box-header">Ζωντανή συζήτηση</div>
                    <div>Η συζήτηση είναι απενεργοποιημένη</div>
                    <div id="chat-bar">
                        <div class="input-group">
                            <input type="text" class="form-control" disabled placeholder="Η συζήτηση είναι απενεργοποιημένη" />
                            <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button" disabled>Send</button></span>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include 'include/php/footer.php';
?>
