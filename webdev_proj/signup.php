<?php
require_once 'config/db.php';

$username = $email = $password = $confirm_password = $role = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $conn->real_escape_string(trim($_POST['username']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $role = $conn->real_escape_string($_POST['role']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Register Successfully.');
        window.location.href = 'login.php';
        </script>";
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $error = addslashes($error);
        echo "<script>
            alert('$error');
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
            background: linear-gradient(to right, #000428, #004e92);
        }

        .container {
            display: flex;
            width: 1200px;
            height: 650px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
        }

        .form-section {
            flex: 0.8;
            padding: 30px;
        }

        .image-section {
            flex: 1;
            background: url('images/sign-up.jpg')
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
            gap: 25px;
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
    <div class="form-section">
        <div class="logo">
            <img src="images/logo.png" alt="Logo">
        </div>
        
        <h1>Register Form</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            <select id="role" name="role">
                <option value="admin" <?php echo ($role === "admin") ? "selected" : ""; ?>>Admin</option>
                <option value="customer" <?php echo ($role === "customer") ? "selected" : ""; ?>>Customer</option>
            </select>
            <button type="submit" class="btn">Register</button>
        </form>

        <div class="footer">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>

    <div class="image-section"></div>
</div>

</body>
</html>
