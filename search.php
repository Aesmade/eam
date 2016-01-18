<?php
    include 'include/php/header.php';
    if (isset($_GET['search-type']) && isset($_GET['search-terms']) && isset($_GET['search-for'])) {
        $terms = htmlspecialchars($_GET['search-terms']);
        $searchtype = $_GET['search-type'];
        $searchfor = $_GET['search-for'];
?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Κεντρική</a></li>
            <li><a href="#">Αναζήτηση</a></li>
            <li><span class="active">Αποτελέσματα</span></li>
        </ol>
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
                    <form action="search.php" class="form-inline">
                        <div class="form-group">
                            <label for="search-dropdown">Αναζήτηση με</label>
                            <select name="search-type" id="search-dropdown" class="form-control">
                                <option value="keyword">Λέξη κλειδί</option>
                                <option value="title">Τίτλο</option>
                                <option value="contents">Περιεχόμενο</option>
                                <option value="writer">Συγγραφέα</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="search-terms">για</label>
                            <input type="text" style="width: 270px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="search-dropdown">σε</label>
                            <select name="search-in" id="search-dropdown" class="form-control">
                                <option value="0">Όλες τις βιβλιοθήκες</option>
                                <option value="1">Βιβλιοθήκη 1</option>
                                <option value="2">Βιβλιοθήκη 2</option>
                                <option value="3">Βιβλιοθήκη 3</option>
                            </select>
                        </div>
                        <input type="hidden" name="search-for" value="all" />
                        <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> Αναζήτηση</button>
                    </form>
                </div>
                <div id="books" class="tab-pane fade">
                    <form action="search.php" class="form-inline">
                        <div class="form-group">
                            <label for="search-dropdown">Αναζήτηση με</label>
                            <select name="search-type" id="search-dropdown" class="form-control">
                                <option value="keyword">Λέξη κλειδί</option>
                                <option value="title">Τίτλο</option>
                                <option value="contents">Περιεχόμενο</option>
                                <option value="writer">Συγγραφέα</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="search-terms">για</label>
                            <input type="text" style="width: 270px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="search-dropdown">σε</label>
                            <select name="search-in" id="search-dropdown" class="form-control">
                                <option value="0">Όλες τις βιβλιοθήκες</option>
                                <option value="1">Βιβλιοθήκη 1</option>
                                <option value="2">Βιβλιοθήκη 2</option>
                                <option value="3">Βιβλιοθήκη 3</option>
                            </select>
                        </div>
                        <input type="hidden" name="search-for" value="book" />
                        <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> Αναζήτηση</button>
                    </form>
                </div>
                <div id="magazines" class="tab-pane fade">
                    <form action="search.php" class="form-inline">
                        <div class="form-group">
                            <label for="search-dropdown">Αναζήτηση με</label>
                            <select name="search-type" id="search-dropdown" class="form-control">
                                <option value="keyword">Λέξη κλειδί</option>
                                <option value="title">Τίτλο</option>
                                <option value="contents">Περιεχόμενο</option>
                                <option value="writer">Συγγραφέα</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="search-terms">για</label>
                            <input type="text" style="width: 270px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="search-dropdown">σε</label>
                            <select name="search-in" id="search-dropdown" class="form-control">
                                <option value="0">Όλες τις βιβλιοθήκες</option>
                                <option value="1">Βιβλιοθήκη 1</option>
                                <option value="2">Βιβλιοθήκη 2</option>
                                <option value="3">Βιβλιοθήκη 3</option>
                            </select>
                        </div>
                        <input type="hidden" name="search-for" value="magazine" />
                        <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> Αναζήτηση</button>
                    </form>
                </div>
                <div id="articles" class="tab-pane fade">
                    <form action="search.php" class="form-inline">
                        <div class="form-group">
                            <label for="search-dropdown">Αναζήτηση με</label>
                            <select name="search-type" id="search-dropdown" class="form-control">
                                <option value="keyword">Λέξη κλειδί</option>
                                <option value="title">Τίτλο</option>
                                <option value="contents">Περιεχόμενο</option>
                                <option value="writer">Συγγραφέα</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="search-terms">για</label>
                            <input type="text" style="width: 270px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="search-dropdown">σε</label>
                            <select name="search-in" id="search-dropdown" class="form-control">
                                <option value="0">Όλες τις βιβλιοθήκες</option>
                                <option value="1">Βιβλιοθήκη 1</option>
                                <option value="2">Βιβλιοθήκη 2</option>
                                <option value="3">Βιβλιοθήκη 3</option>
                            </select>
                        </div>
                        <input type="hidden" name="search-for" value="article" />
                        <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> Αναζήτηση</button>
                    </form>
                </div>
                <div id="polymorphic" class="tab-pane fade">
                    <form action="search.php" class="form-inline">
                        <div class="form-group">
                            <label for="search-dropdown">Αναζήτηση με</label>
                            <select name="search-type" id="search-dropdown" class="form-control">
                                <option value="keyword">Λέξη κλειδί</option>
                                <option value="title">Τίτλο</option>
                                <option value="contents">Περιεχόμενο</option>
                                <option value="writer">Συγγραφέα</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="search-terms">για</label>
                            <input type="text" style="width: 270px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="search-dropdown">σε</label>
                            <select name="search-in" id="search-dropdown" class="form-control">
                                <option value="0">Όλες τις βιβλιοθήκες</option>
                                <option value="1">Βιβλιοθήκη 1</option>
                                <option value="2">Βιβλιοθήκη 2</option>
                                <option value="3">Βιβλιοθήκη 3</option>
                            </select>
                        </div>
                        <input type="hidden" name="search-for" value="polymorphic" />
                        <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> Αναζήτηση</button>
                    </form>
                </div>
                <div id="website" class="tab-pane fade">
                    <form action="search.php" class="form-inline">
                        <div class="form-group">
                            <label for="search-dropdown">Αναζήτηση με</label>
                            <select name="search-type" id="search-dropdown" class="form-control">
                                <option value="keyword">Λέξη κλειδί</option>
                                <option value="title">Τίτλο σελίδας</option>
                                <option value="contents">Περιεχόμενο</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="search-terms">για</label>
                            <input type="text" style="width: 300px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" />
                        </div>
                        <input type="hidden" name="search-for" value="site" />
                        <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> Αναζήτηση</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="flex-container space-between">
                <h3>Αποτελέσματα 1-3 από 3 για "<strong><?php echo $terms ?></strong>"</h3>
                <div class="form-group form-inline">
                    <label for="ordering">Ταξινόμηση κατά&nbsp;</label>
                    <select name="" id="ordering" class="form-control">
                        <option value="">Συνάφεια</option>
                        <option value="">Όνομα</option>
                        <option value="">Ημερομηνία</option>
                        <option value="">Κατηγορία</option>
                    </select>
                </div>
            </div>
            <hr />  
            <div class="search-result row spacing-top">
                <div class="col-sm-2"><img src="resources/img.gif" alt=""></div>
                <div class="col-sm-5">
                    <h4>
                        <a href="#">1. Τίτλος 1</a>
                        <div class="flex-container space-between spacing-top">
                            <div>
                                <div>Από: Όνομα Επώνυμο</div>
                                <div>Κατηγορία: Πληροφορική</div>
                            </div>
                            <div>
                                <div>Έτος: 2015</div>
                                <div>Γλώσσα: Ελληνικά</div>
                            </div>
                        </div>
                    </h4>
                </div>
                <div class="col-sm-2 col-sm-offset-2 spacing-top">
                    <button class="btn btn-default">Προσθήκη στη λίστα μου</button>
                </div>
            </div>
            <div class="search-result row">
                <div class="col-sm-2"><img src="resources/img.gif" alt=""></div>
                <div class="col-sm-5">
                    <h4>
                        <a href="#">2. Τίτλος 2</a>
                        <div class="flex-container space-between spacing-top">
                            <div>
                                <div>Από: Όνομα Επώνυμο</div>
                                <div>Κατηγορία: Πληροφορική</div>
                            </div>
                            <div>
                                <div>Έτος: 2015</div>
                                <div>Γλώσσα: Ελληνικά</div>
                            </div>
                        </div>
                    </h4>
                </div>
                <div class="col-sm-2 col-sm-offset-2 spacing-top">
                    <button class="btn btn-default">Προσθήκη στη λίστα μου</button>
                </div>
            </div>
            <div class="search-result row">
                <div class="col-sm-2"><img src="resources/img.gif" alt=""></div>
                <div class="col-sm-5">
                    <h4>
                        <a href="#">3. Τίτλος 3</a>
                        <div class="flex-container space-between spacing-top">
                            <div>
                                <div>Από: Όνομα Επώνυμο</div>
                                <div>Κατηγορία: Πληροφορική</div>
                            </div>
                            <div>
                                <div>Έτος: 2015</div>
                                <div>Γλώσσα: Ελληνικά</div>
                            </div>
                        </div>
                    </h4>
                </div>
                <div class="col-sm-2 col-sm-offset-2 spacing-top">
                    <button class="btn btn-default">Προσθήκη στη λίστα μου</button>
                </div>
            </div>
            <hr class="spacing-top" />
            <nav class="text-center">
                <ul class="pagination">
                    <li class="disabled">
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li class="disabled">
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
                </div>
        </div>
<?php
    }
    include 'include/php/footer.php';
?>
