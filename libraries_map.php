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
        <ol class="breadcrumb">
            <li><a href="index.php">Αρχική</a></li>
            <li><span class="active">Χάρτης Βιβλιοθηκών</span></li>
        </ol>
        <div class="embed-responsive embed-responsive-16by9">
            <div id="map" class="embed-responsive-item" style="margin: 10px 0"></div>
        </div>
    </div>
    <script type="text/javascript">
        var map;
        function initMap() {
            var point;
            var markerBounds = new google.maps.LatLngBounds();
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8
            });
            
            <?php foreach($libs as $lib) { ?>
            point = new google.maps.LatLng({lat: <?php echo $lib["lat"] ?>, lng: <?php echo $lib["lon"] ?>});
            var marker = new google.maps.Marker({
                position: point,
                map: map
            });
            markerBounds.extend(point);
            <?php } ?>
            map.fitBounds(markerBounds);
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyxoW-t_Qc4yM8gIzG_EnR_In4RSBlEuY&callback=initMap"
    type="text/javascript"></script>
<?php
    include 'include/php/footer.php';
?>
