<?php
    include 'header.php';
?>
    <div class="container">
        <div class="box">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#all">Όλα</a></li>
                <li><a data-toggle="tab" href="#books">Βιβλία</a></li>
                <li><a data-toggle="tab" href="#magazines">Περιοδικά</a></li>
                <li><a data-toggle="tab" href="#articles">Άρθρα</a></li>
                <li><a data-toggle="tab" href="#polymorphic">Πολυμορφικό περιεχόμενο</a></li>
                <li><a data-toggle="tab" href="#website">Ιστόχωρος</a></li>
            </ul>
            <div class="tab-content index-search">
                <div id="all" class="tab-pane fade in active">
                    <form action="#" class="form-inline">
                        <div class="form-group">
                            <label for="search-dropdown">Αναζήτηση με</label>
                            <select name="search-type" id="search-dropdown" class="form-control">
                                <option value="">Λέξη κλειδί</option>
                                <option value="">Τίτλο</option>
                                <option value="">Περιεχόμενο</option>
                                <option value="">Συγγραφέα</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="search-terms">για</label>
                            <input type="text" style="width: 300px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" />
                        </div>
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Αναζήτηση</button>
                    </form>
                </div>
                <div id="books" class="tab-pane fade">
                    <p></p>
                </div>
                <div id="magazines" class="tab-pane fade">
                    <p></p>
                </div>
                <div id="articles" class="tab-pane fade">
                    <p></p>
                </div>
                <div id="polymorphic" class="tab-pane fade">
                    <p></p>
                </div>
                <div id="website" class="tab-pane fade">
                    <p></p>
                </div>
            </div>
            <div class="text-right"><a href="#">Σύνθετη αναζήτηση</a></div>
        </div>
        <div class="row" style="display: flex">
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-header">Βιβλιοθήκες</div>
                    <div>
                        <h3><a href="#"><b>Βιβλιοθήκη 1</b></a></h3>
                        <div>Σήμερα: <strong>09:00 - 21:00</strong></div>
                        <div><a href="#">Πανεπιστημίου 101</a>
                            <div class="pull-right"><span class="glyphicon glyphicon-earphone"></span> 210 1234567</div>
                        </div>
                    </div>
                    <hr class="hor-separator">
                    <div>
                        <h3><a href="#"><b>Βιβλιοθήκη 2</b></a></h3>
                        <div>Σήμερα: <strong>09:00 - 21:00</strong></div>
                        <div><a href="#">Πανεπιστημίου 101</a>
                            <div class="pull-right"><span class="glyphicon glyphicon-earphone"></span> 210 1234567</div>
                        </div>
                    </div>
                    <hr class="hor-separator">
                    <div>
                        <h3><a href="#"><b>Βιβλιοθήκη 3</b></a></h3>
                        <div>Σήμερα: <strong>09:00 - 21:00</strong></div>
                        <div><a href="#">Πανεπιστημίου 101</a>
                            <div class="pull-right"><span class="glyphicon glyphicon-earphone"></span> 210 1234567</div>
                        </div>
                    </div>
                    <div class="box-footer"><a href="#">Προβολή όλων</a></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-header">Ανακοινώσεις</div>
                    <div class="flex-container">
                        <div class="flex-expand">
                            <h3>
                                <a href="#"><b>Πιο πρόσφατος τίτλος</b></a>
                            </h3><span>Κείμενο</span></div>
                        <div><img src="resources/img.gif" alt=""></div>
                    </div>
                    <div class="box-footer"><a href="#">Προβολή όλων</a></div>
                </div>
                <div class="box">
                    <div class="flex-container">
                        <div class="flex-expand">
                            <h3>
                            <a href="#"><b>Ζωντανή συζήτηση</b></a>
                            </h3>
                            <span>Επικοινωνήστε άμεσα μαζί μας</span>
                        </div>
                        <div><img src="resources/img.gif" alt=""></div>
                    </div>
                </div>
                <div class="box">
                    <div class="flex-container">
                        <div class="flex-expand">
                            <h3>
                            <a href="#"><b>Θέσεις εργασίας</b></a>
                            </h3>
                            <span>Στείλτε μας το βιογραφικό σας</span>
                        </div>
                        <div><img src="resources/img.gif" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include 'footer.php';
?>
