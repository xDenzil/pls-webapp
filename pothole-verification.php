<?php

session_start();



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
    <div class="dashboard-main-wrapper bg-primary">

        <?php
        $_SESSION['link'] = 'verification';
        require_once('navigation.php'); // Dynamically loading the navigation bar from one source
        ?>
        <div class="dashboard-wrapper mp">
            <div class="container pt-5 w-75">
                <div class="card text-dark">
                    <div class="card-header">
                        Pothole Verification
                    </div>
                    <div class="card-body">
                        <div class="col-12 figure m-0 p-0 text-center">
                            <img src="img-test.jpeg">
                        </div>

                    </div>
                    <div class="card-footer text-muted">
                        <a href="#" class="btn btn-primary">Previous</a>
                        <a href="#" class="btn btn-primary">Next</a>
                    </div>
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
    <script src="./assets/libs/js/main-js.js"></script>

</body>

</html>