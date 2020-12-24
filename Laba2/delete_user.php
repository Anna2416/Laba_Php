<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "160802anna";
$dbname = "laba2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$array = array();
parse_str($_SERVER['QUERY_STRING'], $array);
$id = $array["id"];

$sql = "DELETE FROM users WHERE id='$id'";
$result = $conn->query($sql);
header("Location:/Laba2/homepage.php");
