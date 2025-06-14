<?php
header('Content-Type: application/json');
require_once 'config.php'; // Your database connection file

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$topProducts = [];

// Assuming your table is named 'inventory' and has columns 'name' and 'stock'
// Adjust table and column names if they are different in your database
$sql = "SELECT name, stock FROM inventory ORDER BY stock DESC LIMIT 5";

$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $topProducts[] = $row;
    }
    $result->close();
} else {
    // Log error or return an error message
    error_log("Error fetching top products by quantity: " . $conn->error);
    // Optionally, you can output a JSON error to be handled by the frontend
    // echo json_encode(['error' => 'Could not fetch top products.']);
    // For now, just return an empty array or handle as needed
}

$conn->close();

echo json_encode($topProducts);
?>