<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO supplier (name, contact_person, email, phone, category) VALUES (?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param( "sssss",$_POST['name'],$_POST['contact_person'], $_POST['email'], $_POST['phone'], $_POST['category']);
    
    if ($stmt->execute()) {
        header("Location: admin_supplier.php?action=update&status=success");
        exit();
    } else {
        // Optional: debug error
        // echo "Execute failed: " . $stmt->error;
        header("Location: admin_supplier.php?action=update&status=error");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>