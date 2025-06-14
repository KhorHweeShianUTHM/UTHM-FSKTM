<?php
session_start();
$_SESSION['staff_id'] = 1; // Hardcoded for testing

$staff_id = $_SESSION['staff_id'];

$pdo = new PDO('mysql:host=localhost;dbname=ahk_workshop', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("UPDATE staff SET profile_photo = NULL WHERE id = ?");
$success = $stmt->execute([$staff_id]);

if ($success) {
    echo "success";
} else {
    echo "error";
}
?>