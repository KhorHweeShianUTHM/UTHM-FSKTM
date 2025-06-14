<?php
include "db.php";

function sanitize($data) {
    return htmlspecialchars(trim($data));
}

// Sanitize input
$userid = sanitize($_POST['userid']);
$password = sanitize($_POST['password']);
$name = sanitize($_POST['name']);
$idnumber = sanitize($_POST['idnumber']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$security_phrase = sanitize($_POST['security_phrase']);

// Check ID birth year
$year = intval(substr($idnumber, 0, 2));
$fullYear = $year < 30 ? 2000 + $year : 1900 + $year;

if ($fullYear <= 2020) {
    echo "<h2 style='color:red;'>Registration blocked: ID birth year must be after 2020.</h2>";
    echo "<p>You will be redirected back in 2 seconds...</p>";
    echo "<script>
            setTimeout(function() {
                window.history.back();
            }, 2000);
          </script>";
    exit;
}

// Salting and hashing
$salt = bin2hex(random_bytes(16)); // 32-char salt
$hash = hash('sha256', $salt . $password);

// Insert into database
$stmt = $conn->prepare("INSERT INTO users (userid, name, idnumber, email, salt, password_hash, security_phrase) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $userid, $name, $idnumber, $email, $salt, $hash, $security_phrase);

if ($stmt->execute()) {
    echo "<h2 style='color:green;'>Registration Successful!</h2>";
    echo "<script>
            setTimeout(function() {
                window.location.href = 'login.php';
            }, 1000);
          </script>";
} else {
    echo "<h2 style='color:red;'>Registration failed. </h2>";
}

$stmt->close();
$conn->close();
?>