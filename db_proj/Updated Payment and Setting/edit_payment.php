<?php
header('Content-Type: application/json');

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ahk_payments";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  http_response_code(500);
  echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
  exit();
}

// Get data from POST (adjust names based on your form/input)
$paymentID = isset($_POST['paymentID']) ? intval($_POST['paymentID']) : 0;
$fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
$method = isset($_POST['method']) ? $_POST['method'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';
$amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;


// Validate input (simple example)
if ($paymentID <= 0 || empty($fullname) || empty($method) || empty($status) || $amount <= 0) {
  http_response_code(400);
  echo json_encode(["error" => "Invalid input data"]);
  exit();
}

// Prepare and bind update statement to avoid SQL injection
$stmt = $conn->prepare("UPDATE payments SET fullname=?, method=?, status=?, amount=?, updated_at=NOW() WHERE paymentID=?");
$stmt->bind_param("sssdi", $fullname, $method, $status, $amount, $paymentID);

if ($stmt->execute()) {
  echo json_encode(["success" => true, "message" => "Payment updated"]);
} else {
  http_response_code(500);
  echo json_encode(["error" => "Failed to update payment: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
