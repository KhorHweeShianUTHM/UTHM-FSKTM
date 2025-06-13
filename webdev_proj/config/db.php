<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kangaroocare";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// For testing
// echo "Connected successfully";
?>