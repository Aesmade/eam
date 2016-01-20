<?php
    include 'include/php/header.php';
    include 'include/php/db_connect.php';
    if (isset($_GET['search-type']) && isset($_GET['search-terms']) && isset($_GET['search-for'])) {
        $terms = htmlspecialchars($_GET['search-terms'], ENT_QUOTES);
        $searchtype = $_GET['search-type'];
        $searchfor = $_GET['search-for'];
        if (!($stmt = $db->prepare("SELECT * FROM books WHERE `Book-Title` LIKE (?) AND `Book-Author` LIKE (?)"))) {
            echo "Prepare failed: (" . $db->errno . ") " . $db->error;
        }
        $searchtitle = "%%";
        $searchauthor = "%%";
        if ($_GET['search-type'] == 'writer')
            $searchauthor = "%".$_GET['search-terms']."%";
        else
            $searchtitle = "%".$_GET['search-terms']."%";
        if (!($stmt->bind_param("ss", $searchtitle, $searchauthor))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        $stmt->execute();
        $stmt->bind_result($isbn, $title, $author, $year, $publisher, $imgs, $imgm, $imgl);
        $stmt->store_result();
?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Κεντρική</a></li>
            <li><a href="#">Αναζήτηση</a></li>
            <li><span class="active">Αποτελέσματα</span></li>
        </ol>
        <div class="box">
            <ul class="nav nav-tabs">
                <li<?php if ($_GET['search-for'] == 'all') echo ' class="active"'; ?>><a data-toggle="tab" href="#all">Όλα</a></li>
                <li<?php if ($_GET['search-for'] == 'book') echo ' class="active"'; ?>><a data-toggle="tab" href="#books">Βιβλία</a></li>
                <li<?php if ($_GET['search-for'] == 'magazine') echo ' class="active"'; ?>><a data-toggle="tab" href="#magazines">Περιοδικά</a></li>
                <li<?php if ($_GET['search-for'] == 'article') echo ' class="active"'; ?>><a data-toggle="tab" href="#articles">Άρθρα</a></li>
                <li<?php if ($_GET['search-for'] == 'polymorphic') echo ' class="active"'; ?>><a data-toggle="tab" href="#polymorphic">Πολυμορφικό περιεχόμενο</a></li>
                <li<?php if ($_GET['search-for'] == 'site') echo ' class="active"'; ?>><a data-toggle="tab" href="#website">Ιστόχωρος</a></li>
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
                            <input type="text" style="width: 270px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" value="<?php if ($_GET['search-for'] == 'all') echo $terms; ?>" />
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
                            <input type="text" style="width: 270px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" value="<?php if ($_GET['search-for'] == 'book') echo $terms; ?>" />
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
                            <input type="text" style="width: 270px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" value="<?php if ($_GET['search-for'] == 'magazine') echo $terms; ?>" />
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
                            <input type="text" style="width: 270px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" value="<?php if ($_GET['search-for'] == 'article') echo $terms; ?>" />
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
                            <input type="text" style="width: 270px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" value="<?php if ($_GET['search-for'] == 'polymorphic') echo $terms; ?>" />
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
                            <input type="text" style="width: 300px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" value="<?php if ($_GET['search-for'] == 'site') echo $terms; ?>" />
                        </div>
                        <input type="hidden" name="search-for" value="site" />
                        <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> Αναζήτηση</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="box">
        <?php if (mysqli_stmt_num_rows($stmt) > 0) { ?>
            <div class="flex-container space-between">
                <h3>Αποτελέσματα 1-<?php echo mysqli_stmt_num_rows($stmt) ?> από <?php echo mysqli_stmt_num_rows($stmt) ?> για "<strong><?php echo $terms ?></strong>"</h3>
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
            <?php
            while ($stmt->fetch()) {
            ?>
            <div class="search-result row">
                <div class="col-sm-2"><img src="<?php echo $imgs ?>" alt=""></div>
                <div class="col-sm-5">
                    <h4>
                        <a href="book.php?isbn=<?php echo $isbn ?>"><?php echo $title ?></a>
                        <div class="flex-container space-between spacing-top">
                            <div>
                                <div>Από: <?php echo $author ?></div>
                                <div>Κατηγορία: Πληροφορική</div>
                            </div>
                            <div>
                                <div>Έτος: <?php echo $year ?></div>
                                <div>Γλώσσα: Αγγλικά</div>
                            </div>
                        </div>
                    </h4>
                </div>
                <div class="col-sm-2 col-sm-offset-2 spacing-top">
                    <button class="btn btn-default">Προσθήκη στη λίστα μου</button>
                </div>
            </div>
            <?php
                }
            ?>
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
            <?php } else { ?>
            <div class="flex-container space-between">
                <h3>Δεν βρέθηκαν αποτελέσματα για "<strong><?php echo $terms ?></strong>"</h3>
            </div>
            <?php } ?>
              </div>
        </div>
        <script>
        (function($) {
            $(function() {
                $('li.active').tab('show');
            });
        })(jQuery);
        </script>
<?php
    }
    include 'include/php/footer.php';
?>
