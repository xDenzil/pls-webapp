<?php

session_start();
include './database/connection.php';

$id = $_GET['id'];
$action = $_GET['action'];

if($action == 'delete'){
  $sql_delete = "DELETE FROM potholes WHERE id='" . $id . "';";
}

$result = $conn->query($sql_delete) or die("Failed to delete item");;
header('Location: active.php');














