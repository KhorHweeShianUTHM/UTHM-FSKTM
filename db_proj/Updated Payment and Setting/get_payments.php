<?php
header('Content-Type: application/json');

// Database connection settings
$servername = "localhost";
$username = "root";      // Change to your DB username
$password = "";          // Change to your DB password
$dbname = "ahk_payments"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  http_response_code(500);
  echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
  exit();
}

// Fetch payments
$sql = "SELECT paymentID, fullname, method, status, amount, datetime, updated_at FROM payments ORDER BY datetime ASC";
$result = $conn->query($sql);

$payments = [];

if ($result) {
  while ($row = $result->fetch_assoc()) {
    $payments[] = $row;
  }
  echo json_encode($payments);
} else {
  http_response_code(500);
  echo json_encode(["error" => "Query failed: " . $conn->error]);
}

$conn->close();
?>
