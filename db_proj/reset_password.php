<?php
// 1. Sambung ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ahk_company";

$conn = new mysqli($servername, $username, $password, $dbname);

// 2. connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $new_password = trim($_POST['new_password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    if (!$email || !$new_password || !$confirm_password) {
        echo "Please fill in all fields.";
        exit;
    }

    if ($new_password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // 4. Hash password baru
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // 5. Kemas kini password dalam database
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Password has been updated!";
        } else {
            echo "Email not found.";
        }
    } else {
        echo "Error while updating:" . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
