<?php
// Sambung ke MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ahk_workshop";

$conn = new mysqli($servername, $username, $password, $dbname);

// Semak sambungan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>