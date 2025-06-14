<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = new mysqli("localhost", "root", "", "ahk_payments");

var_dump($_POST);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fullName = $_POST["fullName"];
$email = $_POST["email"];
$password = password_hash($_POST["password"], PASSWORD_BCRYPT);
$role = $_POST["role"];

$stmt = $conn->prepare("INSERT INTO ahk_users (full_name, email, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $fullName, $email, $password, $role);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>