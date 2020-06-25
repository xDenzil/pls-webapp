<?php

session_start();

include './database/connection.php';

$show_previous = "<button class='btn btn-light' name='previous' role='submit' type='submit'>Previous</button>";
$show_skip = "<button class='btn btn-light' name='skip' role='submit' type='submit'>Skip</button>";



if (isset($_POST['skip'])) {
    $nextquery = "SELECT * FROM potholes WHERE id >" . $_SESSION['current_pothole_v'] . " AND verified=false ORDER BY id ASC LIMIT 1";
    $nextresult = $conn->query($nextquery);
    if (mysqli_num_rows($nextresult) > 0) {
        $nextrow = $nextresult->fetch_assoc();
        $nextid  = $nextrow['id'];
        $_SESSION['current_pothole_v'] = $nextid;
    } else {
        echo ('no more results');
    }
} else if (isset($_POST['verify'])) {
    $verify_query = "UPDATE potholes set verified=true where id=" . $_SESSION['current_pothole_v'] . ";";
    $verify_result = $conn->query($verify_query);


    $nextquery = "SELECT * FROM potholes WHERE id >" . $_SESSION['current_pothole_v'] . " AND verified=false ORDER BY id ASC LIMIT 1";
    $nextresult = $conn->query($nextquery);
    if (mysqli_num_rows($nextresult) > 0) {
        $nextrow = $nextresult->fetch_assoc();
        $nextid  = $nextrow['id'];
        $_SESSION['current_pothole_v'] = $nextid;
    } else {
        echo ('no more results');
    }
} else if (isset($_POST['previous'])) {
    $nextquery = "SELECT * FROM potholes WHERE verified=false AND id = (select max(id) from potholes where id < " . $_SESSION['current_pothole_v'] . ") ORDER BY id ASC LIMIT 1";
    $nextresult = $conn->query($nextquery);
    if (mysqli_num_rows($nextresult) > 0) {
        $nextrow = $nextresult->fetch_assoc();
        $nextid  = $nextrow['id'];
        $_SESSION['current_pothole_v'] = $nextid;
    } else {
        echo ('no more results');
    }
} else if (isset($_POST['urgent'])) {


    if (isset($_GET['id'])) {
        $_SESSION['current_pothole_v'] = $_GET['id'];
        $urgent_query = "UPDATE potholes set status='Urgent', verified=true where id=" . $_GET['id'] . ";";
        $update_result = $conn->query($urgent_query);
        header('Location: active.php');
    } else {
        $urgent_query = "UPDATE potholes set status='Urgent', verified=true where id=" . $_SESSION['current_pothole_v'] . ";";
        $update_result = $conn->query($urgent_query);

        $nextquery = "SELECT * FROM potholes WHERE id >" . $_SESSION['current_pothole_v'] . " AND verified=false ORDER BY id ASC LIMIT 1";
        $nextresult = $conn->query($nextquery);
        if (mysqli_num_rows($nextresult) > 0) {
            $nextrow = $nextresult->fetch_assoc();
            $nextid  = $nextrow['id'];
            $_SESSION['current_pothole_v'] = $nextid;
        } else {
            echo ('no more results');
        }
    }
} else if (isset($_POST['delete'])) {
    $delete_query = "DELETE from potholes where id=" . $_SESSION['current_pothole_v'] . ";";
    $delete_result = $conn->query($delete_query);

    $nextquery = "SELECT * FROM potholes WHERE id >" . $_SESSION['current_pothole_v'] . " AND verified=false ORDER BY id ASC LIMIT 1";
    $nextresult = $conn->query($nextquery);
    if (mysqli_num_rows($nextresult) > 0) {
        $nextrow = $nextresult->fetch_assoc();
        $nextid  = $nextrow['id'];
        $_SESSION['current_pothole_v'] = $nextid;
    } else {
        echo ('no more results');
    }
} else if (isset($_GET['id'])) {
    $nextquery = "SELECT * FROM potholes WHERE id =" . $_GET['id'];
    $nextresult = $conn->query($nextquery);
    $_SESSION['current_pothole_v'] = $_GET['id'];

    if (mysqli_num_rows($nextresult) > 0) {
        $nextrow = $nextresult->fetch_assoc();
        $nextid  = $nextrow['id'];
    } else {
        echo ('no more results');
    }
} else {
    $sql = "SELECT * FROM potholes WHERE verified=false LIMIT 1";
    $result = $conn->query($sql);
    $nextrow = $result->fetch_assoc();
    $_SESSION['current_pothole_v'] = $nextrow['id'];
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
    <div class="dashboard-main-wrapper bg-primary">

        <?php
        $_SESSION['link'] = 'verification';
        require_once('navigation.php'); // Dynamically loading the navigation bar from one source
        ?>
        <div class="dashboard-wrapper" style="background-color:#efeff6;">



            <div class="row p-0 text-dark">
                <div class="col-12">
                    <div class="card mx-auto">
                        <img class=" card-img-top" src="https://felix-cloud-shared-1.s3.us-west-1.amazonaws.com/pls-open/saved-imgs/<?php echo $nextrow['img_url'] ?>" alt="Pothole Image">
                        <div class="card-body">
                            <form class="bg-white m-neg d-flex flex-row justify-content-between" method="POST" action="#">
                                <span>
                                    <button class="btn btn-primary" name="verify" role="submit" type="submit">Verify</button>
                                    <button class="btn btn-danger" name="delete" role="submit" type="submit">Delete</button>
                                </span>
                                <span>
                                    <?php echo (isset($_GET['id']) ? '' : $show_previous); ?>
                                    <button class="btn btn-danger" name="urgent" role="submit" type="submit">Mark Urgent</button>
                                    <?php echo (isset($_GET['id']) ? '' : $show_skip); ?>
                                </span>
                            </form>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Index</th>
                                        <th>Street</th>
                                        <th>Parish</th>
                                        <th>Detected</th>
                                        <th>Map</th>
                                    </tr>
                                <tbody>
                                    <tr>
                                        <td><?php echo $nextrow['id'] ?></th>
                                        <td><?php echo $nextrow['street'] ?></td>
                                        <td><?php echo $nextrow['parish'] ?></td>
                                        <td><?php echo $nextrow['date'] ?></td>
                                        <td><?php echo "<a href='map.php?lat=" . $nextrow['latitude'] . "&long=" . $nextrow['longitude'] . "' class='btn btn-primary btn-xs'>Pinpoint</a>" ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src=" ./assets/vendor/jquery/jquery-3.3.1.min.js"> </script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="./assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="./assets/libs/js/main-js.js"></script>

</body>

</html>