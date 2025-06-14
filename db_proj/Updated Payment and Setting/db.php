<?php
$host = "localhost";
$username = "root";
$password = ""; // leave empty if no password is set in XAMPP
$database = "ahk_payments";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
