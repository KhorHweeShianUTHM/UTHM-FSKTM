<?php
header('Content-Type: application/json');

// Database connection settings (same as your get_payments.php)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ahk_payments";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  http_response_code(500);
  echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
  exit();
}

// Check if id parameter is present
if (!isset($_GET['id'])) {
  http_response_code(400);
  echo json_encode(["error" => "Missing id parameter"]);
  exit();
}

$id = intval($_GET['id']);

// Prepare and execute query to avoid SQL injection
$stmt = $conn->prepare("SELECT paymentID, fullname, method, status, amount, datetime FROM payments WHERE paymentID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
  $payment = $result->fetch_assoc();
  echo json_encode($payment);
} else {
  http_response_code(404);
  echo json_encode(["error" => "Payment not found"]);
}

$stmt->close();
$conn->close();
?>
