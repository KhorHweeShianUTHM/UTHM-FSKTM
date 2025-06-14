<?php
session_start();
include('config.php');

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$requiredRole = 'staff';

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND role = ?");
$stmt->bind_param("sss", $username, $password, $requiredRole);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    session_destroy();
    header('Location: login.html');
    exit();
}

$user = $result->fetch_assoc();
?>