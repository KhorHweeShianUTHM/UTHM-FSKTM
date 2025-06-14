<?php
include("config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = trim($_POST['userid'] ?? '');
    $new_password = trim($_POST['new_password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    if (!$userid || !$new_password || !$confirm_password) {
        echo "Please fill in all fields.";
        exit;
    }

    if ($new_password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $stmt = $conn->prepare("UPDATE users SET password_hash = ? WHERE userid = ?");
    $stmt->bind_param("ss", $hashed_password, $userid);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<script>
                    alert('Password has been successfully updated.');
                    window.location.href = 'login.html';
                  </script>";
        } else {
            echo "<script>
                    alert('User ID not found.');
                    window.location.href = 'login.html';
                  </script>";
        }
    } else {
        echo "An error occurred: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
