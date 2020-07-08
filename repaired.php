<?php
session_start();

include 'config.php';
include 'database/connection.php';

$sql = "SELECT * FROM potholes WHERE repaired=1";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>PLS - Database</title>
    <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="./assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/libs/css/style.css">
    <link rel="stylesheet" href="./assets/libs/css/custom-css.css">
    <link rel="stylesheet" href="./assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="./assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="./assets/vendor/datatables/css/buttons.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="./assets/vendor/datatables/css/select.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="./assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
</head>

<body>
    <?php echo $_ENV['DB_NAME'] ?>
    <?php echo $_ENV['DB_USERNAME'] ?>
    <div class="dashboard-main-wrapper">
        <?php
        $_SESSION['link'] = 'repaired';
        require_once('navigation.php'); // Dynamically loading the navigation bar from one source
        ?>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">


                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Repaired Potholes</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a class="breadcrumb-link">Database</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Repaired Potholes</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Index</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                                <th>Street</th>
                                                <th>Parish</th>
                                                <th>Detected</th>
                                                <th>Status</th>
                                                <th>Image</th>
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
                                                    $date = date_create($row["date"]);
                                                    $formatted_date = date_format($date, "d-m-y h:i A");

                                                    echo ("<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row['latitude'] . "</td>
                    <td>" . $row['longitude'] . "</td>
                    <td>" . $row['street'] . "</td>                                                                
                    <td>" . $row['parish'] . "</td>
                    <td>" . $formatted_date . "</td>
                    <td>");
                                                    if ($row["status"] == 'Normal') {
                                                        echo ("<span class='mr-2'> <span class='badge-dot badge-primary'></span>Normal</span>");
                                                    } else {
                                                        echo ("<span class='mr-2'> <span class='badge-dot badge-secondary'></span>Urgent</span>");
                                                    };
                                                    echo ("</td>
                    <td><a href='https://cloud-cube.s3.amazonaws.com/qzcmng30imti/public/" . $row['img_url'] . "' target='_blank'>Image</a></td>
                    <td>
                    <a href='map.php?lat=" . $row['latitude'] . "&long=" . $row['longitude'] . "' class='btn btn-primary btn-xs' role='button'>Pinpoint</a>
                    </td>
                    <td>
                    <a href='./scripts/actions.php?id=" . $row['id'] . "&action=unrepaired' class='btn btn-warning btn-xs' role='button'>Undo Repaired</a>
                    </td>
                    <td>
                    <a href='./scripts/actions.php?id=" . $row['id'] . "&action=delete' role='button' class='btn btn-secondary btn-xs'>Delete</a>
                    </td>
                </tr>");
                                                }
                                            } else {
                                                echo "<p>No results at the moment.</p>";
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
</body>

</html>