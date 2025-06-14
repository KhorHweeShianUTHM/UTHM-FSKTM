<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "ahk_payments";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$userId = $_POST['editUserId'] ?? null;
$fullName = $_POST['editFullName'] ?? null;
$email = $_POST['editEmail'] ?? null;
$password = $_POST['editPassword'] ?? null;
$role = $_POST['role_edit'] ?? null;

// Validate user ID
if ($userId === null) {
    die("User ID is missing.");
}

// Prepare update data
$updates = [];
$params = [];
$types = "";

// Only add fields that are provided
if (!empty($fullName)) {
    $updates[] = "full_name = ?";
    $params[] = $fullName;
    $types .= "s";
}
if (!empty($email)) {
    $updates[] = "email = ?";
    $params[] = $email;
    $types .= "s";
}
if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $updates[] = "password = ?";
    $params[] = $hashedPassword;
    $types .= "s";
}
if (!empty($role)) {
    $updates[] = "role = ?";
    $params[] = $role;
    $types .= "s";
}

// If no data to update
if (empty($updates)) {
    die("No fields to update.");
}

$query = "UPDATE ahk_users SET " . implode(", ", $updates) . " WHERE user_id = ?";
$params[] = $userId;
$types .= "i";

// Prepare and execute
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param($types, ...$params);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "success";
} else {
    echo "nochange";
}

$stmt->close();
$conn->close();
?>
