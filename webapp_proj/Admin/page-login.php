<?php
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Database connection and login validation
$conn = new mysqli('localhost', 'root', '', 'swiss_collection');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
} else {
    // Fetch user based on email
    $stmt = $conn->prepare("SELECT * FROM adminlogin WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        // Verify entered password against stored hashed password
        if (password_verify($password, $storedPassword)) {
            $isAdmin = $row['is_admin'];

            if ($isAdmin == 1) {
                // User is an admin, grant access to admin panel
                header("Location: index.php");
                exit();
            } else {
                // Non-admin users may be redirected elsewhere or an error shown
                header("Location: /error_page.php?error=not_admin");
                exit();
            }
        }
    }

    // If no matching user or password doesn't match, redirect to login page
    header("Location: /page-login.html?error=invalid_credentials");
    exit();

    $stmt->close();
    $conn->close();
}

?>
