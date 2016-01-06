<?php
    include 'header.php';
?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Κεντρική</a></li>
            <li><span class="active">Επικοινωνία</span></li>
        </ol>
        <div class="row">
            <div class="col-sm-7">
                <div class="box" style="height: 630px">
                    <div class="box-header">Κάντε μας μια ερώτηση</div>
                    <div class="form-group"><label for="titleInput">Τίτλος</label><input type="text" name="titleInput" id="titleInput" class="form-control" placeholder="Τίτλος"></div>
                    <div class="form-group"><label for="infoInput">Περισσότερες πληροφορίες</label><textarea name="infoInput" id="infoInput" rows="6" class="form-control" placeholder="Περισσότερες πληροφορίες"></textarea></div>
                    <div class="form-horizontal" style="margin-top: 30px">
                        <label style="padding-top: 10px; padding-bottom: 10px;">Τα στοιχεία σας</label>
                        <div class="form-group"><label class="col-sm-3" for="nameInput">Όνομα</label><div class="col-sm-9"><input type="text" name="inputText" id="inputText" placeholder="Όνομα" class="form-control"></div></div>
                        <div class="form-group"><label class="col-sm-3" for="nameEmail">E-mail</label><div class="col-sm-9"><input type="text" name="emailText" id="emailText" placeholder="E-mail" class="form-control"></div></div>
                    </div>
                    <button type="submit" style="margin-top: 20px" class="pull-right btn btn-primary">Αποστολή ερώτησης</button>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="box" style="height: 300px">
                    <div class="box-header">Συχνές ερωτήσεις</div>
                    <div><a href="#">Πώς μπορώ να βρω ένα βιβλίο;</a></div>
                    <div><a href="#">Πού βρίσκονται οι βιβλιοθήκες;</a></div>
                    <div><a href="#">Πώς δανείζομαι ένα βιβλίο;</a></div>
                    <div><a href="#">Πως μπορώ να παραγγείλω ένα άρθρο;</a></div>
                    <div><a href="#">Πως μπορώ να εργαστώ στη βιβλιοθήκη;</a></div>
                    <div class="text-right" style="font-size: 15px; position: absoute; bottom: 0;"><a href="#">Περισσότερες ερωτήσεις και Βοήθεια</a></div>
                </div>
                <div class="box" style="height: 300px; position: relative;">
                    <div class="box-header">Ζωντανή συζήτηση</div>
                    <div>Η συζήτηση είναι απενεργοποιημένη</div>
                    <div class="chat-bar">
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
    include 'footer.php';
?>