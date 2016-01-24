<?php
    include 'include/php/db_connect.php';
    include 'include/php/helpers.php';

    $lib = array();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT name, description, address, latitude, longitude, " .
            "telephone, email, opening_time, closing_time, img FROM `Library` where id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($lib['name'], $lib['description'], $lib['address'],
                $lib['lat'], $lib['lon'], $lib['tel'], $lib['email'], $lib['open'], $lib['close'], $lib['img']);
            $stmt->fetch();
            foreach ($lib as $key => $value) {
                $lib[$key] = htmlspecialchars($value);
            }
        } else {
            // If library doesn't exist.
            $stmt->free_result();
            $stmt->close();
            $db->close();
            // Redirect to the page not found page.
            header('Location: page_not_found.php');
            exit();
        }
        $stmt->free_result();
        $stmt->close();
    }

    $db->close();

    // include header.php and library.css
    $styles = array("%OTHER_STYLESHEET_1%" => "rel=\"stylesheet\" href=\"styles/library.css\"");
    echo replace_contents('include/php/header.php', $styles);
?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.php">Αρχική</a></li>
            <li><a href="libraries_calendar.php">Βιβλιοθήκες</a></li>
            <li><span class="active"><?php echo $lib['name'] ?></span></li>
        </ol>
        <div class="row">
            <div class="col-sm-3">
                <div class="box">
                    <div class="box-header">Ώρες λειτουργίας</div>
                    <div>
                        <div>Σήμερα: <strong><?php echo substr($lib['open'], 0, 5) . " - " . substr($lib['close'], 0, 5) ?></strong></div>
                        <hr />
                        <div><a href="libraries_calendar.php">Εβδομαδιαίο Ωράριο</a></div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">Επικοινωνία</div>
                    <div>
                        <strong>
                        <div><span class="glyphicon glyphicon-earphone"></span> <?php echo $lib['tel'] ?></div>
                        <div><span class="glyphicon glyphicon-envelope"></span> <?php echo $lib['email'] ?></div>
                        <hr />
                        <div><span class="glyphicon glyphicon-map-marker"></span> <?php echo $lib['address'] ?></div>
                        </strong>
                        <div><a href="#" data-toggle="modal" data-target="#myModal">Προβολή στο χάρτη</a></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="box">
                    <div class="box-header"><?php echo $lib['name'] ?></div>
                    <div id="lib-content-left">
                        <div><strong>Γνωστικό Αντικείμενο</strong></div>
                        <p class="content"><?php echo $lib['description'] ?></p>
                        <div><strong>Συλλογή Ανοικτής Πρόσβασης</strong></div>
                        <p class="content">Η Συλλογή Ανοικτής Πρόσβασης περιλαμβάνει βιβλία, περιοδικά, οπτικοακουστικό υλικό, γκρίζα βιβλιογραφία (διδακτορικές διατριβές, διπλωματικές και πτυχιακές εργασίες), ανάτυπα εργασιών, σημειώσεις μαθημάτων, λεξικά, εγκυκλοπαίδειες και χάρτες. Τα βιβλία είναι ταξιθετημένα σύμφωνα με το δεκαδικό σύστημα ταξινόμησης Dewey, ενώ τα περιοδικά έχουν ταξιθετηθεί με απόλυτη αλφαβητική σειρά τίτλου.</p>
                        <div><strong>Συλλογή Περιορισμένης Πρόσβασης</strong></div>
                        <p class="content">Η Συλλογή Περιορισμένης Πρόσβασης περιλαμβάνει σπάνιο και πολύτιμο υλικό το οποίο φυλάσσεται σε ειδικά διαμορφωμένη αίθουσα. Οι χρήστες έχουν πρόσβαση ύστερα από ειδική άδεια, για περιορισμένο χρονικό διάστημα και μόνο στο χώρο της βιβλιοθήκης που θα υποδείξει το προσωπικό της</p>
                    </div><!--
                 --><div id="lib-content-right">
                        <div id="lib-image-div">
                            <img src="<?php echo $lib['img'] ?>" alt="" id="lib-image">
                        </div>
                        <div id="links-div">
                            <div><strong>Υπηρεσίες</strong></div>
                            <div class="content">
                                <ul>
                                    <li><a href="search.php?search-type=title&search-terms=&search-in=<?php echo $id ?>&search-for=all">Αναζήτηση τίτλων</a></li>
                                    <li><a href="search.php?search-type=title&search-terms=&search-in=<?php echo $id ?>&search-for=all">Βιβλία & συλλογές</a></li>
                                    <li><a href="#">Κανονισμοί δανεισμού</a></li>
                                    <li><a href="#">Για ΑΜΕΑ</a></li>
                                    <li><a href="#">Περισσότερες Υπηρεσίες</a></li>
                                </ul>
                            </div>
                            <br />
                            <div><strong>Ομάδες Μελέτης</strong></div>
                            <div class="content">
                                <ul>
                                    <li><a href="#">Ομάδα στο Facebook</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal" role="dialog">
        <div class="modal-dialog modal-lg">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo $lib['name'] ?></h4>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <div id="map" class="embed-responsive-item"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var myLatLng = {lat: <?php echo $lib['lat'] ?>, lng: <?php echo $lib['lon'] ?>};
        var map = null;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: '<?php echo $lib['address'] ?>'
            });
        }

        $('#myModal').on('shown.bs.modal', function () {
            google.maps.event.trigger(map, "resize");
            map.setCenter(myLatLng);
            map.setZoom(14);
        });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyxoW-t_Qc4yM8gIzG_EnR_In4RSBlEuY&callback=initMap"
    type="text/javascript"></script>
<?php
    include 'include/php/footer.php';
?>
