<?php
$conn = new mysqli("localhost", "root", "", "ws_proj");

if ($conn->connect_error) {
    die("Connection failed." . $conn->connect_error);
}
?>