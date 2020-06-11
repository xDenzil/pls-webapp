<?php
session_start();
include './database/connection.php';

$sql = "SELECT * FROM potholes WHERE repaired=0";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>PLS - Database</title>
    <!-- Bootstrap CSS -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="./assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/libs/css/style.css">
    <link rel="stylesheet" href="./assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="./assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="./assets/vendor/datatables/css/buttons.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="./assets/vendor/datatables/css/select.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="./assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/libs/css/custom-css.css">
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <?php
        $_SESSION['link'] = 'active';
        require_once('navigation.php'); // Dynamically loading the navigation bar from one source
        ?>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">


                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Active Potholes</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a class="breadcrumb-link">Database</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Active Potholes</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEARCH FIELDS -->
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">Batch Operations</div>
                            <div class="card-body">
                                <form class="form-search" method="GET">
                                    <div class="row  align-items-end">

                                        <div class="col-md-6 col-lg-4 pb-2 pb-lg-0">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Street/Road</span>
                                                </div>
                                                <input type="text" name="min_price" class="form-control <?php if (isset($price_min_search_error)) {
                                                                                                            echo "is-invalid";
                                                                                                        } ?>" type="text" value="<?php echo $_SESSION['price_min_search'] ?>">
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-lg-2 pb-2 pb-lg-0">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">From</span>
                                                </div>
                                                <input type="text" name="min_price" class="form-control <?php if (isset($price_min_search_error)) {
                                                                                                            echo "is-invalid";
                                                                                                        } ?>" type="text" value="<?php echo $_SESSION['price_min_search'] ?>">
                                            </div>

                                        </div>
                                        <div class="col-md-6 col-lg-2 pb-2 pb-lg-0">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">To</span>
                                                </div>
                                                <input type="text" name="max_price" class="form-control <?php if (isset($price_max_search_error)) {
                                                                                                            echo "is-invalid";
                                                                                                        } ?>" type="text" value="<?php echo $_SESSION['price_max_search'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-2 pb-2 pb-lg-0">
                                            <select class="selectpicker" data-style="btn-light" data-width="100%" name="property_type" title="Status">
                                                <option>Normal</option>
                                                <option>Urgent</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 col-lg-2 pb-2 pb-lg-0">
                                            <input class="btn btn-success text-white btn-block rounded-2" role="submit" name="property_search" type="submit" value="Search">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- ============================================================== -->
                    <!-- data table  -->
                    <!-- ============================================================== -->
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Index</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                                <th>Street/Road</th>
                                                <th>Parish</th>
                                                <th>Detection Date</th>
                                                <th>Status</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $result->fetch_assoc()) {
                                                    echo ("<tr>
                                                                <td>" . $row["id"] . "</td>
                                                                <td>" . $row['latitude'] . "</td>
                                                                <td>" . $row['longitude'] . "</td>
                                                                <td>" . $row['street'] . "</td>                                                                
                                                                <td>" . $row['parish'] . "</td>
                                                                <td>" . $row["date"] . "</td>
                                                                <td>");
                                                    if ($row["status"] == 'Normal') {
                                                        echo ("<span class='mr-2'> <span class='badge-dot badge-primary'></span>Normal</span>");
                                                    } else {
                                                        echo ("<span class='mr-2'> <span class='badge-dot badge-secondary'></span>Urgent</span>");
                                                    };
                                                    echo ("</td>
                                                                <td>
                                                                <a href='map.php?lat=" . $row['latitude'] . "&long=" . $row['longitude'] . "' class='btn btn-primary btn-xs' role='button'>Pinpoint</a>
                                                                </td>
                                                                <td>
                                                                <a href='./scripts/actions.php?id=" . $row['id'] . "&action=repaired' class='btn btn-success btn-xs' role='button'>Repaired</a>
                                                                </td>
                                                                <td>
                                                                <a href='./scripts/actions.php?id=" . $row['id'] . "&action=delete' role='button' class='btn btn-secondary btn-xs'>Delete</a>
                                                                </td>
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
                    <!-- ============================================================== -->
                    <!-- end data table  -->
                    <!-- ============================================================== -->
                </div>

            </div>

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
    <script src="./assets/vendor/multi-select/js/jquery.multi-select.js"></script>
    <script src="./assets/libs/js/main-js.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="./assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="./assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="./assets/vendor/datatables/js/data-table.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
</body>

</html>