<?php
    include 'include/php/db_connect.php';
    include 'include/php/helpers.php';
    include 'include/php/queries/query_libraries.php';

    $libs = all_libraries($db);
    $db->close();

    // include header.php and library.css
    $styles = array('%OTHER_STYLESHEET_1%' => 'rel="stylesheet" href="styles/index.css"');
    echo replace_contents('include/php/header.php', $styles);
?>
    <div class="container">
        <div class="box">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#all">Όλα</a></li>
                <li><a data-toggle="tab" href="#books">Βιβλία</a></li>
                <li><a data-toggle="tab" href="#magazines">Περιοδικά</a></li>
                <li><a data-toggle="tab" href="#articles">Άρθρα</a></li>
                <li><a data-toggle="tab" href="#polymorphic">Πολυμορφικό περιεχόμενο</a></li>
                <li><a data-toggle="tab" href="#libraries">Βιβλιοθήκες</a></li>
            </ul>
            <div class="tab-content index-search">
                <div id="all" class="tab-pane fade in active">
                    <form action="search.php" class="form-inline">
                        <div class="form-group">
                            <label for="search-dropdown">Αναζήτηση με</label>
                            <select name="search-type" id="search-dropdown" class="form-control">
                                <option value="title">Τίτλο</option>
                                <option value="contents">Περιεχόμενο</option>
                                <option value="author">Συγγραφέα</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="search-terms">για</label>
                            <input type="text" style="width: 250px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="search-dropdown">σε</label>
                            <select name="search-in" id="search-dropdown" class="form-control">
                                <option value="0">Όλες τις βιβλιοθήκες</option>
                                <?php
                                    foreach ($libs as $lib) {
                                ?>
                                <option value="<?php echo $lib['id'] ?>"><?php echo substr($lib['name'], strlen("Βιβλιοθήκη ")) ?></option>
                                <?php
                                    }
                                ?>
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
                                <option value="title">Τίτλο</option>
                                <option value="contents">Περιεχόμενο</option>
                                <option value="author">Συγγραφέα</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="search-terms">για</label>
                            <input type="text" style="width: 250px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="search-dropdown">σε</label>
                            <select name="search-in" id="search-dropdown" class="form-control">
                                <option value="0">Όλες τις βιβλιοθήκες</option>
                                <?php
                                    foreach ($libs as $lib) {
                                ?>
                                <option value="<?php echo $lib['id'] ?>"><?php echo substr($lib['name'], strlen("Βιβλιοθήκη ")) ?></option>
                                <?php
                                    }
                                ?>
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
                                <option value="title">Τίτλο</option>
                                <option value="contents">Περιεχόμενο</option>
                                <option value="author">Συγγραφέα</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="search-terms">για</label>
                            <input type="text" style="width: 250px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="search-dropdown">σε</label>
                            <select name="search-in" id="search-dropdown" class="form-control">
                                <option value="0">Όλες τις βιβλιοθήκες</option>
                                <?php
                                    foreach ($libs as $lib) {
                                ?>
                                <option value="<?php echo $lib['id'] ?>"><?php echo substr($lib['name'], strlen("Βιβλιοθήκη ")) ?></option>
                                <?php
                                    }
                                ?>
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
                                <option value="title">Τίτλο</option>
                                <option value="contents">Περιεχόμενο</option>
                                <option value="author">Συγγραφέα</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="search-terms">για</label>
                            <input type="text" style="width: 250px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="search-dropdown">σε</label>
                            <select name="search-in" id="search-dropdown" class="form-control">
                                <option value="0">Όλες τις βιβλιοθήκες</option>
                                <?php
                                    foreach ($libs as $lib) {
                                ?>
                                <option value="<?php echo $lib['id'] ?>"><?php echo substr($lib['name'], strlen("Βιβλιοθήκη ")) ?></option>
                                <?php
                                    }
                                ?>
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
                                <option value="title">Τίτλο</option>
                                <option value="contents">Περιεχόμενο</option>
                                <option value="author">Συγγραφέα</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="search-terms">για</label>
                            <input type="text" style="width: 250px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="search-dropdown">σε</label>
                            <select name="search-in" id="search-dropdown" class="form-control library-select">
                                <option value="0">Όλες τις βιβλιοθήκες</option>
                                <?php
                                    foreach ($libs as $lib) {
                                ?>
                                <option value="<?php echo $lib['id'] ?>"><?php echo substr($lib['name'], strlen("Βιβλιοθήκη ")) ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="search-for" value="polymorphic" />
                        <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> Αναζήτηση</button>
                    </form>
                </div>
                <div id="libraries" class="tab-pane fade">
                    <form action="search.php" class="form-inline">
                        <div class="form-group">
                            <label for="search-dropdown">Αναζήτηση με</label>
                            <select name="search-type" id="search-dropdown" class="form-control">
                                <option value="name">Όνομα</option>
                                <option value="address">Διεύθυνση</option>
                                <option value="contents">Περιεχόμενο</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="search-terms">για</label>
                            <input type="text" style="width: 350px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" />
                        </div>
                        <input type="hidden" name="search-for" value="libraries" />
                        <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> Αναζήτηση</button>
                    </form>
                </div>
            </div>
            <div class="text-right"><a href="#">Σύνθετη αναζήτηση</a></div>
        </div>
        <div class="row" style="display: flex">
            <div class="col-sm-7">
                <div class="box">
                    <div class="box-header">Βιβλιοθήκες</div>
                    <?php
                        foreach ($libs as $lib) {
                    ?>
                    <div class="row" style="padding: 5px">
                        <div class="col-sm-3">
                            <img src="<?php echo $lib['img'] ?>" alt="" style="height: 100px; width:100px; image-fit:contain;">
                        </div>
                        <div class="col-sm-9">
                            <h4><a href="library.php?id=<?php echo $lib['id'] ?>"><b><?php echo $lib['name'] ?></b></a></h4>
                            <div>
                                <span>Σήμερα: <strong><?php echo substr($lib['open'], 0, 5) ?> - <?php echo substr($lib['close'], 0, 5) ?></strong></span>
                            </div>
                            <div>
                                <span><?php echo $lib['address'] ?></span>
                                <div class="pull-right"><span class="glyphicon glyphicon-earphone"></span> <?php echo $lib['phone'] ?></div>
                            </div>
                        </div>
                    </div>
                    <?php
                            if ($lib['id'] != $libs[count($libs) - 1]['id']) {
                    ?> 
                    <hr />
                    <?php
                            }
                        }
                    ?>
                    <div class="box-footer"><a href="libraries_calendar.php">Προβολή όλων</a></div>
                </div>
            </div>
            <div class="col-sm-5">
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
    include 'include/php/footer.php';
?>
