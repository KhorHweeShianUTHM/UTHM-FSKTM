<?php
header('Content-Type: application/json');

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ahk_workshop';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed'
    ]);
    exit;
}

$sql = "SELECT id, name, role, LOWER(availability) as availability FROM staff";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode([
        'success' => false,
        'message' => 'Query failed'
    ]);
    exit;
}

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'role' => $row['role'],
        'availability' => $row['availability']
    ];
}

echo json_encode([
    'success' => true,
    'data' => $data
]);
$conn->close();
