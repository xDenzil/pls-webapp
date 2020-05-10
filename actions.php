<?php

session_start();
include './database/connection.php';

$id = $_GET['id'];
$action = $_GET['action'];

if ($action == 'delete') {
  $sql_query = "DELETE FROM potholes WHERE id='" . $id . "';";
}

if ($action == 'repaired') {
  $sql_query =  "UPDATE potholes SET repaired = '1' WHERE id = '" . $id . "';";
}

if ($action == 'unrepaired') {
  $sql_query =  "UPDATE potholes SET repaired = '0' WHERE id = '" . $id . "';";
}

$result = $conn->query($sql_query) or die("Failed to execute query");;
header('Location: active.php');
