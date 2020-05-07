<?php

session_start();
include './database/connection.php';

$id = $_GET['id'];
$action = $_GET['action'];

if($action == 'delete'){
  $sql_delete = "DELETE FROM potholes WHERE id='" . $id . "';";
}

$result = $conn->query($sql);
header('Location: active.php');














