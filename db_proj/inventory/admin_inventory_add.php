<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $stmt = $conn->prepare("INSERT INTO inventory ( inventory_name, category, sku, price, stock, status) VALUES (?, ?, ?, ?, ?, ?)");
    
if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $_POST['inventory_name'], $_POST['category'], $_POST['sku'], $_POST['price'], $_POST['stock'], $_POST['status']);
    
    if ($stmt->execute()) {
        header("Location: admin_inventory.php");
        exit();
    } else {
        // For debugging, you can echo $stmt->error here
        header("Location: admin_inventory.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
