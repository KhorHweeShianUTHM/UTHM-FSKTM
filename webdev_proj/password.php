<?php
require_once 'config/db.php'; 

$email = $new_password = $confirm_password = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        if ($new_password === $confirm_password) {

            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            $update_sql = "UPDATE users SET password='$hashed_password' WHERE email='$email'";

            if ($conn->query($update_sql) === TRUE) {
                echo "<script>
                    alert('Password reset successful! You can now log in with your new password.');
                    window.location.href = 'login.php';
                    </script>";
            } else {
                $error = "Error updating password: " . $conn->error;
                $error = addslashes($error);
                echo "<script>
                    alert('$error');
                    window.location.href = 'password.php';
                    </script>";
            }
        } else {
            echo "<script>
                alert('Passwords do not match.');
                window.location.href = 'password.php';
                </script>";
        }
    } else {
        echo "<script>
            alert('No account found with this email.');
            window.location.href = 'password.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('images/reset-pass.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            width: 400px;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            width: 100px;
            height: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .footer a {
            color: #0000EE;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logo">
        <img src="images/logo.png" alt="Logo">
    </div>

    <h1>Reset Password</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="email" id="email" name="email" placeholder="Email" required>
        <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm New Password" required>
        <button type="submit" class="btn">Reset Password</button>
    </form>

    <div class="footer">
        Back to <a href="login.php">Login</a>
    </div>
</div>

</body>
</html>