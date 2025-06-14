<?php
session_start();
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "swiss_collection";

    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
	
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in, redirect to profile page
    header("Location: user-profile.php");
    exit();
} else {
    // User is not logged in, redirect to login page
    header("Location: user-login.php");
    exit();
}
?>