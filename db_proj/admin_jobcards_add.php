<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $created_at = date('Y-m-d H:i:s'); // Set current time
    $stmt = $conn->prepare("INSERT INTO job_cards (name, date_in, status, service, remarks, amount, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        "sssssss",
        $_POST['name'],
        $_POST['date_in'],
        $_POST['status'],
        $_POST['service'],
        $_POST['remarks'],
        $_POST['amount'],
        $created_at
    );

    if ($stmt->execute()) {
        header("Location: admin_jobcards.php?action=update&status=success");
        exit();
    } else {
        // Optional: debug error
        // echo "Execute failed: " . $stmt->error;
        header("Location: admin_jobcards.php?action=update&status=error");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
