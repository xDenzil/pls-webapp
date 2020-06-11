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
$database_nav = '';


if ($_SESSION['link'] == 'map') {
    $map = 'active';
} else if ($_SESSION['link'] == 'dashboard') {
    $dashboard = 'active';
} else if ($_SESSION['link'] == 'active') {
    $active = 'active';
    $database_nav = 'show';
} else if ($_SESSION['link'] == 'repaired') {
    $repaired = 'active';
    $database_nav = 'show';
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
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="true" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-database"></i>Database</a>
                        <div id="submenu-5" class="submenu collapse <?php echo $database_nav ?>">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link p-3 <?php echo $active ?>" href="active.php">Active Potholes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-3  <?php echo $repaired ?>" href="repaired.php">Repaired Potholes</a>
                                </li>
                            </ul>
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

</html>