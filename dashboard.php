<?php

session_start();
$_SESSION['link'] = '';
include './database/connection.php';
include './scripts/time_elapsed.php';

$query_detected = "SELECT * FROM potholes ORDER BY date DESC;";
$query_urgent = "SELECT * FROM potholes WHERE status='Urgent' AND repaired=0 ORDER BY date DESC;";
$query_repaired = "SELECT * FROM potholes WHERE repaired=1;";


$result_detected = $conn->query($query_detected);
$result_urgent = $conn->query($query_urgent);
$result_repaired = $conn->query($query_repaired);
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
        $_SESSION['link'] = 'dashboard';
        require_once('navigation.php'); // Dynamically loading the navigation bar from one source
        ?>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">System Dashboard</h2>
                            <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a class="breadcrumb-link">Main</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- ============================================================== -->
                    <!-- four widgets   -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- total views   -->
                    <!-- ============================================================== -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h5 class="text-muted">Potholes<br>Detected</h5>
                                    <h2 class="mb-0">
                                        <?php
                                        $detected_count = 0;
                                        $detected_count += mysqli_num_rows($result_detected);
                                        echo ($detected_count);
                                        mysqli_close($conn);
                                        ?>
                                    </h2>
                                </div>
                                <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                                    <i class="fa fa-eye fa-fw fa-sm text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end total views   -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- total followers   -->
                    <!-- ============================================================== -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h5 class="text-muted">Potholes<br>Repaired</h5>
                                    <h2 class="mb-0">
                                        <?php
                                        $repaired_count = 0;
                                        $repaired_count += mysqli_num_rows($result_repaired);
                                        echo ($repaired_count);
                                        mysqli_close($conn);
                                        ?>
                                    </h2>
                                </div>
                                <div class="float-right icon-circle-medium  icon-box-lg  bg-brand-light mt-1">
                                    <i class="fa fa-wrench fa-fw fa-sm text-brand"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end partnerships   -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- total earned   -->
                    <!-- ============================================================== -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h5 class="text-muted">Potholes<br>Active</h5>
                                    <h2 class="mb-0">
                                        <?php
                                        $active_count = $detected_count - $repaired_count;
                                        echo ($active_count);
                                        ?>

                                    </h2>
                                </div>
                                <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                                    <i class="fa fa-exclamation fa-fw fa-sm text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end total followers   -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- partnerships   -->
                    <!-- ============================================================== -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h5 class="text-muted">Marked<br>Urgent</h5>
                                    <h2 class="mb-0">
                                        <?php
                                        $urgent_count = 0;
                                        $urgent_count += mysqli_num_rows($result_urgent);
                                        mysqli_close($conn);
                                        echo ($urgent_count);
                                        ?>
                                    </h2>
                                </div>
                                <div class="float-right icon-circle-medium  icon-box-lg  bg-secondary-light mt-1">
                                    <i class="fa fa-exclamation-triangle fa-fw fa-sm text-secondary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end total earned   -->
                    <!-- ============================================================== -->
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card bg-primary text-white text-center p-3">
                            <blockquote class="blockquote mb-0">
                                <p class='mb-2'><strong>The Autonomous Pothole Detection Project</strong></p>
                                <footer class="blockquote-footer text-white">
                                    Use this web application to navigate and manipulate the data being sent by the PLS, a physical pothole detection
                                    device mounted on roaming vehicles in Kingston, Jamaica. You may complete <a href="https://forms.gle/uWo22dULdoutxGMAA" style="color:white;text-decoration: underline;">this survey</a> whenever you're ready, this is of course voluntary.
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="m-0 p-0">Most Recenly Detected</h5> <a href="active.php" class="btn btn-primary btn-xs">See All <i class='fas fa-arrow-right ml-1'></i></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first">
                                    <thead>
                                        <tr>
                                            <th>Street</th>
                                            <th>Parish</th>
                                            <th>Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result_detected->num_rows > 0) {
                                            // output data of each row
                                            for ($i = 0; $i < 3; $i++) {
                                                $row2 = $result_detected->fetch_assoc();
                                                echo ("<tr>
                                                            <td>" . $row2["street"] . "</td>
                                                            <td>" . $row2["parish"] . "</td>
                                                            <td>" . time_elapsed_string($row2["date"], true) . "</td>
                                                        </tr>");
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        $conn->close();

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="m-0 p-0">Urgent Attention</h5> <a href="#" class="btn btn-secondary btn-xs">See All <i class='fas fa-arrow-right ml-1'></i></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first">
                                    <thead>
                                        <tr>
                                            <th>Street</th>
                                            <th>Parish</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result_urgent->num_rows > 0) {
                                            // output data of each row
                                            for ($z = 0; $z < 3; $z++) {
                                                $row3 = $result_urgent->fetch_assoc();
                                                echo ("<tr>
                                                            <td>" . $row3["street"] . "</td>
                                                            <td>" . $row3["parish"] . "</td>
                                                            <td>" . $row3["date"] . "</td>
                                                        </tr>");
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        $conn->close();

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
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