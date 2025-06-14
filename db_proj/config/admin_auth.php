<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit();
}

// User is logged in and is admin
$userid = $_SESSION['user_id']; // or user_name if you prefer
?>