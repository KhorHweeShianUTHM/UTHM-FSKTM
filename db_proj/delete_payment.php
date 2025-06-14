<?php
// 1. Connect to your database
$servername = "localhost"; // or your DB host
$username = "root";        // your DB username
$password = "";            // your DB password
$dbname = "ahk_payments";  // your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Get the payment ID from POST or GET request
if (isset($_POST['paymentID'])) {
    $paymentID = intval($_POST['paymentID']);  // sanitize input

    // 3. Prepare and execute delete statement
    $stmt = $conn->prepare("DELETE FROM payments WHERE paymentID = ?");
    $stmt->bind_param("i", $paymentID);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => "Payment deleted successfully."]);
    } else {
        echo json_encode(['success' => false, 'message' => "Failed to delete payment."]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => "No paymentID provided."]);
}

$conn->close();
?>
