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
            point = new google.maps.LatLng({lat: <?php echo $lib['lat'] ?>, lng: <?php echo $lib['lon'] ?>});
            var marker = new google.maps.Marker({
                position: point,
                map: map
            });
            
            var content = '<div id="content">'+
                '<a href="library.php?id=<?php echo $lib["id"] ?>"><div class="headline-text"><?php echo $lib["name"] ?></div></a>'+
                '<div id="bodyContent">'+
                '<p style="text-align: justify">'+'<?php echo $lib["description"] ?>'+'</p>'+
                '<span>Ώρες λειτουργίας: <?php echo substr($lib["open"], 0, 5) ?> - <?php echo substr($lib["close"], 0, 5) ?></span>'+
                '<span class="pull-right">Διεύθυνση: <?php echo $lib["address"] ?></span>'+
                '</div>'+
                '</div>';

            var infowindow = new google.maps.InfoWindow();

            google.maps.event.addListener(marker, 'mouseover', (function(marker,content,infowindow){ 
                return function() {
                    infowindow.setContent(content);
                    infowindow.open(map,marker);
                };
            })(marker,content,infowindow));

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
