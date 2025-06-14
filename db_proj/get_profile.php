<?php
session_start();
$_SESSION['staff_id'] = 1; // Hardcoded for testing

$staff_id = $_SESSION['staff_id'];

$pdo = new PDO('mysql:host=localhost;dbname=ahk_workshop', 'root', '');
$stmt = $pdo->prepare("SELECT name, email, role, profile_photo FROM staff WHERE id = ?");
$stmt->execute([$staff_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user['profile_photo']) {
    $user['profile_photo'] = 'https://placehold.co/120x120/E2E8F0/4A5568?text=Avatar';
}

echo json_encode($user);
?>