<?php

// Start the session
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

$login = $_POST['login'];
$password = $_POST["password"];

$sql = "SELECT * FROM users  LEFT JOIN roles ON users.role_id=roles.role_id WHERE login='$login' and password='$password' and users.role_id=roles.role_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $email = $row["email"];
    $_SESSION["user_name"] = $first_name ." ". $last_name;
    $_SESSION["first_name"] = $first_name;
    $_SESSION["last_name"] = $last_name;
    $_SESSION["email"] = $email;
    $_SESSION["id"] = $row["id"];
    $_SESSION["role"] = $row["role_name"];
    header("Location:/Laba2/homepage.php");
} else {
    header("Location:/Laba2/homepage.php");
}
