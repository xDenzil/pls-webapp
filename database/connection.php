<?php

$servername = "z37udk8g6jiaqcbx.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "w51mbu1rmltjyy69";
$password = "flrs0u96gq73xnjp";
$dbname = "l6ccblkqef08hptd";
$port = "3306";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
