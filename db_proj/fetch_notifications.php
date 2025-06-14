<?php
header('Content-Type: application/json');

$host = '127.0.0.1';            // Your database host
$dbname = 'ahk_workshop';        // Your database name
$username = 'root';      // Your database username
$password = '';  // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("
        SELECT title, description, timestamp 
        FROM notifications 
        ORDER BY timestamp DESC 
        LIMIT 5
    ");
    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($notifications);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>