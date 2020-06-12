<?php

session_start();
if (isset($_GET['lat']) && isset($_GET['long'])) {
    $path = 'pinpoint';
    $latitude = $_GET['lat'];
    $longitude = $_GET['long'];
    $zoom = 16;
} else {
    $path = 'all';
    $latitude = 18.091699;
    $longitude = -77.363632;
    $zoom = 10;
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>PLS - Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css" />
    <link href="./assets/vendor/fonts/circular-std/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/libs/css/style.css" />
    <link rel="stylesheet" href="./assets/libs/css/custom-css.css" />
    <link rel="stylesheet" href="./assets/vendor/fonts/fontawesome/css/fontawesome-all.css" />
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">

        <?php
        $_SESSION['link'] = 'map';
        require_once('navigation.php'); // Dynamically loading the navigation bar from one source
        ?>
        <div class="dashboard-wrapper bg-primary mp">
            <div id="map"></div>
            <script>
                var path = '<?php echo ($path) ?>';

                var map;

                function initMap() {
                    var pinpoint = {
                        lat: <?php echo ($latitude) ?>,
                        lng: <?php echo ($longitude) ?>
                    }
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: pinpoint,
                        zoom: <?php echo ($zoom) ?>,
                        streetViewControl: false,
                        zoomControlOptions: {
                            position: google.maps.ControlPosition.RIGHT_CENTER
                        },
                    });

                    var infoWindow = new google.maps.InfoWindow;

                    if (path == 'pinpoint') {
                        var marker = new google.maps.Marker({
                            position: pinpoint,
                            map: map,
                            animation: google.maps.Animation.BOUNCE
                        });

                    } else {
                        downloadUrl('./scripts/marker_generator.php', function(data) {
                            var xml = data.responseXML;
                            var markers = xml.documentElement.getElementsByTagName('marker');
                            var markerss = [];

                            Array.prototype.forEach.call(markers, function(markerElem) {
                                var id = markerElem.getAttribute('id');
                                var street = markerElem.getAttribute('street');
                                var parish = markerElem.getAttribute('parish');
                                var point = new google.maps.LatLng(
                                    parseFloat(markerElem.getAttribute('lat')),
                                    parseFloat(markerElem.getAttribute('lng')));


                                var infowincontent = document.createElement('div');
                                var strong = document.createElement('strong');
                                strong.textContent = street + ', ' + parish;
                                infowincontent.appendChild(strong);
                                infowincontent.appendChild(document.createElement('br'));

                                var text = document.createElement('text');
                                text.textContent = 'Lat: ' + parseFloat(markerElem.getAttribute('lat')) + ' Long: ' + parseFloat(markerElem.getAttribute('lng'));
                                infowincontent.appendChild(text);



                                var marker = new google.maps.Marker({
                                    map: map,
                                    position: point,
                                });

                                marker.addListener('click', function() {
                                    infoWindow.setContent(infowincontent);
                                    infoWindow.open(map, marker);
                                });
                                markerss.push(marker);
                            });
                            var markerCluster = new MarkerClusterer(map, markerss, {
                                imagePath: './images/m'
                            });
                        });

                        function downloadUrl(url, callback) {
                            var request = window.ActiveXObject ?
                                new ActiveXObject('Microsoft.XMLHTTP') :
                                new XMLHttpRequest;

                            request.onreadystatechange = function() {
                                if (request.readyState == 4) {
                                    request.onreadystatechange = doNothing;
                                    callback(request, request.status);
                                }
                            };

                            request.open('GET', url, true);
                            request.send(null);
                        }

                        function doNothing() {}
                    }


                }
            </script>
            <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAKrYd2b-ceSJOqO-ejr1R1c2qXB51SaM&callback=initMap"></script>

            <!-- CONTAINER END -->

            <?php require_once('footer.php'); ?>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="./assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="./assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="./assets/libs/js/main-js.js"></script>

    <script>
        $('.collapse').on('shown.bs.collapse', function() {
            $(this).parent().find(".fa-angle-down").removeClass("fa-angle-down").addClass("fa-angle-up");
        }).on('hidden.bs.collapse', function() {
            $(this).parent().find(".fa-angle-up").removeClass("fa-angle-up").addClass("fa-angle-down");
        });

        $('.panel-heading a').click(function() {
            $('.panel-heading').removeClass('active');

            //If the panel was open and would be closed by this click, do not active it
            if (!$(this).closest('.panel').find('.panel-collapse').hasClass('in'))
                $(this).parents('.panel-heading').addClass('active');
        });
    </script>
</body>

</html>