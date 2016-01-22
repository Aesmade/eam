<?php
    include 'include/php/header.php';
    include 'include/php/db_connect.php';
    include 'include/php/queries/query_libraries.php';

    $libs = all_libraries($db);

    if (isset($_GET['search-type']) && isset($_GET['search-terms']) && isset($_GET['search-for']) && $_GET['search-for'] == 'libraries') {
        $terms = htmlspecialchars($_GET['search-terms'], ENT_QUOTES);
        $searchtype = $_GET['search-type'];
        $searchfor = $_GET['search-for'];
        
        if ($searchtype == 'name')
            $query = 'SELECT id, name, address, telephone, email, opening_time, closing_time, img FROM `Library` WHERE name LIKE ?';
        else if ($searchtype == 'contents')
            $query = 'SELECT id, name, address, telephone, email, opening_time, closing_time, img FROM `Library` WHERE description LIKE ?';
        else if ($searchtype == 'address')
            $query = 'SELECT id, name, address, telephone, email, opening_time, closing_time, img FROM `Library` WHERE address LIKE ?';

        if (!($stmt = $db->prepare($query))) {
            echo 'Prepare failed: (' . $db->errno . ') ' . $db->error;
        }

        $searchterms = '%'.$_GET['search-terms'].'%';
        $stmt->bind_param('s', $searchterms);
        $stmt->execute();
        $stmt->bind_result($id, $name, $address, $telephone, $email, $open, $close, $imgs);
        $stmt->store_result();
    } else if (isset($_GET['search-type']) && isset($_GET['search-terms']) && isset($_GET['search-for']) && isset($_GET['search-in'])) {
        $terms = htmlspecialchars($_GET['search-terms'], ENT_QUOTES);
        $searchtype = $_GET['search-type'];
        $searchfor = $_GET['search-for'];
        $searchin = intval($_GET['search-in']);

        if ($searchtype == 'title')
            $query = 'SELECT isbn, title, publication_date, type, imgs FROM `Book` WHERE title LIKE ?';
        else if ($searchtype == 'contents')
            $query = 'SELECT isbn, title, publication_date, type, imgs FROM `Book` WHERE description LIKE ?';
        else if ($searchtype == 'author')
            $query = 'SELECT isbn, title, publication_date, type, imgs FROM `Book` WHERE isbn IN (SELECT book_isbn FROM 
                `Book_Authors`, `Author` WHERE `Book_Authors`.author_id = `Author`.id AND `Author`.name LIKE ?)';
        
        if ($searchfor != 'all')
             $query .= ' AND type = ?';

        if ($searchin != 0)
            $query .= " AND isbn IN (SELECT book_isbn FROM `Books_at_Libraries` WHERE library_id = $searchin AND quantity > 0)";

        if (!($stmt = $db->prepare($query))) {
            echo 'Prepare failed: (' . $db->errno . ') ' . $db->error;
        }

        $searchterms = '%'.$_GET['search-terms'].'%';
        if ($searchfor == 'all')
            $stmt->bind_param('s', $searchterms);
        else
            $stmt->bind_param('ss', $searchterms, $searchfor);

        $stmt->execute();
        $stmt->bind_result($isbn, $title, $pub_date, $type, $imgs);
        $stmt->store_result();
        
        $types = array('book' => 'Βιβλίο', 'magazine' => 'Περιοδικό', 'article' => 'Άρθρο', 'polymorphic' => 'Πολυμορφικό Περιεχόμενο');
    }
?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.php">Αρχική</a></li>
            <li><a href="search.php">Αναζήτηση</a></li>
            <li><span class="active">Αποτελέσματα</span></li>
        </ol>
        <div class="box">
            <ul class="nav nav-tabs">
                <li<?php if ($searchfor == 'all' or !isset($searchfor)) echo ' class="active"'; ?>><a data-toggle="tab" href="#all">Όλα</a></li>
                <li<?php if ($searchfor == 'book') echo ' class="active"'; ?>><a data-toggle="tab" href="#books">Βιβλία</a></li>
                <li<?php if ($searchfor == 'magazine') echo ' class="active"'; ?>><a data-toggle="tab" href="#magazines">Περιοδικά</a></li>
                <li<?php if ($searchfor == 'article') echo ' class="active"'; ?>><a data-toggle="tab" href="#articles">Άρθρα</a></li>
                <li<?php if ($searchfor == 'polymorphic') echo ' class="active"'; ?>><a data-toggle="tab" href="#polymorphic">Πολυμορφικό περιεχόμενο</a></li>
                <li<?php if ($searchfor == 'libraries') echo ' class="active"'; ?>><a data-toggle="tab" href="#libraries">Βιβλιοθήκες</a></li>
            </ul>
            <div class="tab-content index-search">
                <div id="all" class="tab-pane fade<?php if ($searchfor == 'all' or $searchfor == '') echo ' in active'; ?>">
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
                            <input type="text" style="width: 250px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" value="<?php if ($searchfor == 'all') echo $terms; ?>" />
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
                <div id="books" class="tab-pane fade<?php if ($searchfor == 'book') echo ' in active'; ?>">
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
                            <input type="text" style="width: 250px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" value="<?php if ($searchfor == 'book') echo $terms; ?>" />
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
                <div id="magazines" class="tab-pane fade<?php if ($searchfor == 'magazine') echo ' in active'; ?>">
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
                            <input type="text" style="width: 250px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" value="<?php if ($searchfor == 'magazine') echo $terms; ?>" />
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
                <div id="articles" class="tab-pane fade<?php if ($searchfor == 'article') echo ' in active'; ?>">
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
                            <input type="text" style="width: 250px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" value="<?php if ($searchfor == 'article') echo $terms; ?>" />
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
                <div id="polymorphic" class="tab-pane fade<?php if ($searchfor == 'polymorphic') echo ' in active'; ?>">
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
                            <input type="text" style="width: 250px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" value="<?php if ($searchfor == 'polymorphic') echo $terms; ?>" />
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
                        <input type="hidden" name="search-for" value="polymorphic" />
                        <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> Αναζήτηση</button>
                    </form>
                </div>
                <div id="libraries" class="tab-pane fade <?php if ($searchfor == 'libraries') echo ' in active'; ?>">
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
                            <input type="text" style="width: 350px" placeholder="Όροι αναζήτησης" name="search-terms" id="search-terms" class="form-control" value="<?php if ($searchfor == 'libraries') echo $terms; ?>"/>
                        </div>
                        <input type="hidden" name="search-for" value="libraries" />
                        <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> Αναζήτηση</button>
                    </form>
                </div>
            </div>
        </div>
        <?php if (isset($_GET['search-for'])) { ?>
        <div class="box">
        <?php if (mysqli_stmt_num_rows($stmt) > 0) { ?>
            <div class="flex-container space-between">
                <span>Αποτελέσματα 1 έως <?php echo mysqli_stmt_num_rows($stmt) ?> από <?php echo mysqli_stmt_num_rows($stmt) ?> για "<strong><?php echo $terms ?></strong>"</span>
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
                if ($searchfor == 'libraries') {
                    while ($stmt->fetch()) {
            ?>
            <div class="search-result row">
                <div class="col-sm-3">
                    <img src="<?php echo $imgs ?>" alt="" style="height: 150px; width: 100%; image-fit: contain;">
                </div>
                <div class="col-sm-9">
                    <h4>
                        <strong><a href="library.php?id=<?php echo $id ?>"><?php echo $name ?></a></strong>
                        <div class="flex-container space-between spacing-top">
                            <div>
                                <div>Ωράριο: <?php echo substr($open, 0, 5) . ' - ' . substr($close, 0, 5) ?> (σήμερα)</div>
                                <div>E-mail: <?php echo $email ?></div>
                                <div>Τηλέφωνο: <?php echo $telephone ?></div>
                                <div>Διεύθυνση: <?php echo $address ?></div>
                            </div>
                        </div>
                    </h4>
                </div>
            </div>            
            <?php
                    }
                } else {
                    $authorstmt = $db->prepare('SELECT `Author`.name, `Author`.id FROM `Author`, `Book_Authors` 
                        WHERE `Book_Authors`.book_isbn = ? AND `Author`.id = `Book_Authors`.author_id');
                    $libstmt = $db->prepare('SELECT `Library`.name, `Library`.id FROM `Library`, `Books_at_Libraries` 
                        WHERE `Books_at_Libraries`.book_isbn = ? AND `Library`.id = `Books_at_Libraries`.library_id');
                    while ($stmt->fetch()) {
            ?>
            <div class="search-result row">
                <div class="col-sm-2"><img src="<?php echo $imgs ?>" alt="" style="height: 100px; widht: 100px"></div>
                <div class="col-sm-6">
                    <h4>
                        <strong><a href="book.php?isbn=<?php echo $isbn ?>"><?php echo $title ?></a></strong>
                        <div class="flex-container space-between spacing-top">
                            <div>
                                <div>Συγγραφείς: <?php
                                    $authorstmt->bind_param('s', $isbn);
                                    $authorstmt->execute();
                                    $authorstmt->bind_result($authorname, $authorid);

                                    if ($authorstmt->fetch()) {
                                        echo "<a href='search.php?search-type=author&search-terms=$authorname&search-in=0&search-for=all'>$authorname</a>";
                                        while ($authorstmt->fetch())
                                            echo ", <a href='search.php?search-type=author&search-terms=$authorname&search-in=0&search-for=all'>$authorname</a>";
                                    }
                                ?></div>
                                <div>Βιβλιοθήκη: <?php
                                    $libstmt->bind_param('s', $isbn);
                                    $libstmt->execute();
                                    $libstmt->bind_result($libname, $libid);

                                    if ($libstmt->fetch()) {
                                        $libname = substr($libname, strlen("Βιβλιοθήκη"));
                                        echo "<a href='library.php?id=$libid'>$libname</a>";
                                    }
                                ?>
                                </div>
                            </div>
                            <div>
                                <div>Έτος: <?php echo $pub_date ?></div>
                                <div>Τύπος: <?php echo $types[$type] ?></div>
                            </div>
                        </div>
                    </h4>
                </div>
                <div class="col-sm-2 col-sm-offset-1 spacing-top">
                    <button class="btn btn-default">Προσθήκη στη λίστα μου</button>
                </div>
            </div>
            <?php
                    }
                    $authorstmt->close();
                    $libstmt->close();
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
                <span>Δεν βρέθηκαν αποτελέσματα για "<strong><?php echo $terms ?></strong>"</span>
            </div>
        <?php } ?>
        </div>
        <?php } ?>
    </div>
    <script>
    (function($) {
        $(function() {
            $('li.active').tab('show');
            var dropdowns = $('.active.in #search-dropdown');
            <?php if (isset($searchtype)) { ?>
                dropdowns.first().val('<?php echo $searchtype; ?>');
            <?php } if (isset($searchin)) { ?>
                dropdowns.last().val('<?php echo $searchin; ?>');
            <?php } ?>
        });
    })(jQuery);
    </script>
<?php
    $stmt->close();
    $db->close();
    include 'include/php/footer.php';
?>
