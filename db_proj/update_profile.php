<?php
session_start();
$_SESSION['staff_id'] = 1; // Hardcoded for testing

$staff_id = $_SESSION['staff_id'];

// Get POST data
$name = $_POST['name'];
$email = $_POST['email'];

if (!preg_match('/@gmail\.com$/', $email)) {
    echo "Only gmail.com emails are allowed";
    exit;
}
// Connect to DB
$pdo = new PDO('mysql:host=localhost;dbname=ahk_workshop', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Update query (do NOT update title/role here, as you want it readonly)
$stmt = $pdo->prepare("UPDATE staff SET name = ?, email = ? WHERE id = ?");
$success = $stmt->execute([$name, $email, $staff_id]);

if ($success) {
    echo "success";
} else {
    echo "error";
}
?>