<?php
session_start();

//Converting the dates to the date format being used in the database

if ($_GET['date_from_search'] == null) {
    $date1 = date_create($_GET['date_from_search']);
    $d1 = date_format($date1, "Y/m/d H:i:s");
}
if ($_GET['date_to_search'] == null) {
    $date2 = date_create($_GET['date_to_search']);
    $d2 = date_format($date2, "Y/m/d H:i:s");
}

// If the batch search button is pressed

if (isset($_GET['batch_search'])) {

    // Set variables

    $street_search = $_GET['street_search'];
    $date_from_search = $_GET['date_from_search'];
    $date_to_search = $_GET['date_to_search'];
    $status_search = $_GET['status_search'];

    // Concatenate SQL string with wildcards
    empty($street_search) ? $street_sql = "AND street LIKE '%'" : $street_sql = "AND street LIKE '%$street_search%'";
    empty($status_search) ? $status_sql = "AND status LIKE '%'" : $status_sql = "AND status = '$status_search'";
    empty($date_from_search) ? $date_from_search = '0000-00-00 00:00:00' : $date_from_search = $date_from_search;
    empty($date_to_search) ? $date_to_search = '0000-00-00 00:00:00' : $date_to_search = $date_to_search;

    // Check for conditions
    if ($date_from_search == '0000-00-00 00:00:00' & $date_to_search == '0000-00-00 00:00:00') {
        $date_sql = '';
    } else if ($date_to_search == '0000-00-00 00:00:00') {
        $date_sql = "AND date >= '$d1'";
    } else if ($date_from_search == '0000-00-00 00:00:00') {
        $date_sql = "AND date <= '$d2'";
    } else {
        $date_sql = "AND date >= '$d1' AND date <= '$d2'";
    }

    // Run query
    include '../database/connection.php';
    $query = "SELECT * FROM potholes WHERE id IS NOT NULL $street_sql $status_sql $date_sql;";
    $result = mysqli_query($conn, $query) or die("Failed to get data.");
    $row_cnt = mysqli_num_rows($result);
    //echo ($query);
    //printf("Result set has %d rows.\n", $row_cnt);
    /* close result set */
    //header('Location: ../active.php');
    mysqli_free_result($result);
    mysqli_close($conn);
}
