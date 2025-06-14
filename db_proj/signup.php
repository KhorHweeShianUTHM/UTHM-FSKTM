<?php
include("config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = trim($_POST['userid'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $role = trim($_POST['role'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($userid && $name && $role && $email && $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (userid, name, role, email, password_hash) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $userid, $name, $role, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Success: redirect
            echo "<script>
                    alert('Signup successful! Redirecting to login page...');
                    window.location.href = 'login.html';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('SQL error: " . addslashes($stmt->error) . "');
                    window.history.back();
                  </script>";
        }

        $stmt->close();
    } else {
        // Missing field(s): Show alert instead of redirect
        echo "<script>
                alert('Please fill in all fields.');
                window.history.back();
              </script>";
        exit;
    }
}

$conn->close();
?>