<?php
header('Content-Type: application/json');
require 'config.php';

function send_error($msg) {
    echo json_encode(['success' => false, 'error' => $msg]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    send_error('Invalid request method.');
}

// Sanitize and validate inputs
$inventory_name = trim($_POST['inventory_name'] ?? '');
$category = trim($_POST['category'] ?? '');
$sku = trim($_POST['sku'] ?? '');
$price = $_POST['price'] ?? '';
$stock = $_POST['stock'] ?? '';
$status = trim($_POST['status'] ?? '');

if (strlen($inventory_name) < 2) send_error('Inventory name must be at least 2 characters.');
if (empty($category)) send_error('Category is required.');
if (empty($sku)) send_error('SKU is required.');
if (!is_numeric($price) || $price <= 0) send_error('Price must be a positive number.');
if (!is_numeric($stock) || intval($stock) < 0) send_error('Stock must be zero or greater.');
if (empty($status)) send_error('Status is required.');

$price = floatval($price);
$stock = intval($stock);

// Insert query
$stmt = $conn->prepare("INSERT INTO inventory (inventory_name, category, sku, price, stock, status) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) send_error('Prepare failed: ' . $conn->error);

$stmt->bind_param('sssdis', $inventory_name, $category, $sku, $price, $stock, $status);

if (!$stmt->execute()) {
    send_error('Execute failed: ' . $stmt->error);
}

$inserted_id = $stmt->insert_id;
$stmt->close();

// Fetch the inserted record to return
$result = $conn->query("SELECT * FROM inventory WHERE inventory_id = $inserted_id");
$item = $result->fetch_assoc();

echo json_encode(['success' => true, 'item' => $item]);
