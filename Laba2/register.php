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
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$role_id = $_POST["role_id"];
$email = $_POST["email"];
$login = $_POST['login'];
$password = $_POST["password"];


$insert_query = "INSERT INTO users (first_name, last_name, login ,password, role_id, email) 
            VALUES ('$first_name', '$last_name','$login', '$password', '$role_id', '$email');";
$result = $conn->query($insert_query);
$get_user_data = "SELECT * FROM users LEFT JOIN roles ON users.role_id=roles.role_id WHERE login='$login' and password='$password' and users.role_id=roles.role_id";
$result = $conn->query($get_user_data);

$row = $result->fetch_assoc();

$_SESSION["first_name"] = $first_name;
$_SESSION["last_name"] = $last_name;
$_SESSION["email"] = $email;
$_SESSION["role"] = $row["role_name"];
$_SESSION["id"] = $row["id"];
$_SESSION["user_name"] = $first_name . " " . $last_name;

header("Location:/Laba2/homepage.php");