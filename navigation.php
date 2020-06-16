<?php
session_start();

/* 
Here I'm reading the variable sent from the nav code on each page to
dynamically set the active states for the links.
*/

$map = '';
$dashboard = '';
$active = '';
$repaired = '';
$verification = '';


if ($_SESSION['link'] == 'map') {
    $map = 'active';
} else if ($_SESSION['link'] == 'dashboard') {
    $dashboard = 'active';
} else if ($_SESSION['link'] == 'active') {
    $active = 'active';
} else if ($_SESSION['link'] == 'repaired') {
    $repaired = 'active';
} else if ($_SESSION['link'] == 'repaired') {
    $verification = 'active';
}


?>


<html>
<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-md navbar-light"><a class="d-xl-none d-md-none">Smart Pothole Location System</a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">Main</li>
                    <li class="nav-item"><a class="nav-link <?php echo $dashboard ?>" href="dashboard.php"><i class="fa fa-fw fa-rocket"></i>Dashboard <span class="badge badge-success">6</span></a></li>
                    <li class="nav-divider">Data</li>
                    <li class="nav-item"><a class="nav-link <?php echo $map ?>" href="map.php"><i class="fa fa-fw fa-map-marker-alt"></i>Pothole Map<span class="badge badge-success">6</span></a></li>
                    <li class="nav-item"><a class="nav-link <?php echo $active ?>" href="active.php"><i class="fa fa-fw fa-database"></i>Active Potholes<span class="badge badge-success">6</span></a></li>
                    <li class="nav-item"><a class="nav-link <?php echo $repaired ?>" href="repaired.php"><i class="fa fa-fw fa-database"></i>Repaired Potholes<span class="badge badge-success">6</span></a></li>
                    <li class="nav-item"><a class="nav-link <?php echo $verification ?>" href="pothole-verification.php"><i class="fa fa-fw fa-pen-square"></i>Pothole Verification<span class="badge badge-success">6</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-fw fa-chart-pie"></i>Statistics<span class="badge badge-success">6</span></a></li>
                    <li class="nav-divider">User</li>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="fa fa-fw fa-power-off"></i>Logout <span class="badge badge-success">6</span></a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>

</html>