<?php
header('Content-Type: application/json');

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

$fullname = $data['fullname'];
$method = $data['method'];
$status = $data['status'];
$amount = $data['amount'];

$mysqli = new mysqli("localhost", "root", "", "ahk_payments");

if ($mysqli->connect_error) {
  echo json_encode(["success" => false, "error" => "Database connection failed."]);
  exit();
}

$stmt = $mysqli->prepare("INSERT INTO payments (fullname, method, status, amount) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssd", $fullname, $method, $status, $amount);

if ($stmt->execute()) {
  $newId = $stmt->insert_id;

  // Retrieve the inserted row including the auto-filled datetime
  $result = $mysqli->query("SELECT * FROM payments WHERE paymentID = $newId");
  $payment = $result->fetch_assoc();

  echo json_encode(["success" => true, "payment" => $payment]);
} else {
  echo json_encode(["success" => false, "error" => "Insert failed."]);
}

$stmt->close();
$mysqli->close();
?>
