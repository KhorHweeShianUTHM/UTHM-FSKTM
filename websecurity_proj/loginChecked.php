<?php
session_start();
include "db.php"; // Connection $conn

function sanitize($data) {
    return htmlspecialchars(trim($data));
}

// Sanitize input
$userid = sanitize($_POST['userid']);
$password = sanitize($_POST['password']);
$security_phrase = sanitize($_POST['security_phrase']);
$captcha = intval($_POST['captcha']);

// CAPTCHA check
if ($captcha !== $_SESSION['captcha']) {
    echo "<script>
            alert('Captcha incorrect.');
            window.location.href = 'login.php';
            </script>";
            exit;
}

// Fetch user
$stmt = $conn->prepare("SELECT * FROM users WHERE userid = ?");
$stmt->bind_param("s", $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $hash = hash('sha256', $user['salt'] . $password);

    if ($hash === $user['password_hash']) {
        if ($security_phrase === $user['security_phrase']) {
            $_SESSION['user_id'] = $user['userid'];
            $_SESSION['name'] = $user['name'];
            echo "<h2 style='color:green;'>Login successful!</h2>";
            echo "<script>
            setTimeout(() => { 
                window.location.href = 'dashboard.php'; 
                }, 2000);
                </script>";
        } else {
            echo "<script>
                alert('Wrong security phrase.');
                window.location.href = 'login.php';
            </script>";
            exit;
        }
    } else {
            echo "<script>
                alert('Incorrect password.');
                window.location.href = 'login.php';
            </script>";
            exit;
    }
} else {
            echo "<script>
                alert('User not found.');
                window.location.href = 'login.php';
            </script>";
            exit;
}
?>