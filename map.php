<?php

session_start();
if (isset($_GET['lat']) && isset($_GET['long'])) {
    $path = 'pinpoint';
    $latitude = $_GET['lat'];
    $longitude = $_GET['long'];
    $zoom = 16;

    $marker = 'var marker = new google.maps.Marker({
        position: pinpoint,
        map: map,
        animation: google.maps.Animation.BOUNCE
    });';
} else {
    $path = 'all';
    $latitude = 18.091699;
    $longitude = -77.363632;
    $zoom = 10;
    $marker = null;
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
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light"><a class="d-xl-none d-lg-none">Menu</a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">Main</li>
                            <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fa fa-fw fa-rocket"></i>Dashboard <span class="badge badge-success">6</span></a></li>
                            <li class="nav-divider">Data</li>
                            <li class="nav-item"><a class="nav-link active" href="map.php"><i class="fa fa-fw fa-map-marker-alt"></i>Pothole Map<span class="badge badge-success">6</span></a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="true" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-database"></i>Database</a>
                                <div id="submenu-5" class="submenu collapse">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link p-3" href="active.php">Active Potholes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link p-3" href="repaired.php">Repaired Potholes</a>
                                        </li>

                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-fw fa-chart-pie"></i>Statistics<span class="badge badge-success">6</span></a></li>
                            <li class="nav-divider">User</li>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="login.php"><i class="fa fa-fw fa-power-off"></i>Logout <span class="badge badge-success">6</span></a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper bg-primary mp">
            <div id="map"></div>



            <script>
                var path = '<?php echo ($path) ?>';
                if (path == 'pinpoint') {
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
                        <?php echo ($marker) ?>
                    }
                } else {
                    function initMap() {
                        var map = new google.maps.Map(document.getElementById('map'), {
                            center: new google.maps.LatLng(<?php echo ($latitude) ?>, <?php echo ($longitude) ?>),
                            zoom: <?php echo ($zoom) ?>,
                            streetViewControl: false,
                            zoomControlOptions: {
                                position: google.maps.ControlPosition.RIGHT_CENTER
                            },
                        });
                        var infoWindow = new google.maps.InfoWindow;

                        // Change this depending on the name of your PHP or XML file
                        downloadUrl('markers.php', function(data) {
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


                    }



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
            </script>
            <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAKrYd2b-ceSJOqO-ejr1R1c2qXB51SaM&callback=initMap"></script>


            <!-- CONTAINER END -->



            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">Copyright © D Williams, T Morgan, S Palmer, R Bromfield, K Blackwood.</div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block"><a href="javascript: void(0);">About</a><a href="javascript: void(0);">Support</a><a href="javascript: void(0);">Contact Us</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
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