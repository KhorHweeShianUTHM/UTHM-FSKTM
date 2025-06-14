<?php
session_start();
$_SESSION['staff_id'] = 1; // Hardcoded for testing

$staff_id = $_SESSION['staff_id'];
$currentPassword = $_POST['current_password'];
$newPassword = trim($_POST['new_password']); // Trim whitespace

$pdo = new PDO('mysql:host=localhost;dbname=ahk_workshop', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get the current hashed password from DB
$stmt = $pdo->prepare("SELECT password FROM staff WHERE id = ?");
$stmt->execute([$staff_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($currentPassword, $user['password'])) {
    echo "error";
    exit;
}

if (
    strlen($newPassword) < 8 ||
    !preg_match('/[A-Z]/', $newPassword) ||
    !preg_match('/[a-z]/', $newPassword) ||
    !preg_match('/[0-9]/', $newPassword) ||
    !preg_match('/[^A-Za-z0-9]/', $newPassword)
) {
    echo "weak";
    exit;
}

$hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
$update = $pdo->prepare("UPDATE staff SET password = ? WHERE id = ?");
$update->execute([$hashedPassword, $staff_id]);
echo "success";
?>