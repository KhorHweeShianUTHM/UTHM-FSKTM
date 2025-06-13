<?php
require_once 'config/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $conn->real_escape_string($_POST['username']);
    $password = trim($_POST['password']);

    // Step 1: Check in the 'users' table for admin and customer roles
    $sql_users = "SELECT * FROM users WHERE username='$username'";
    $result_users = $conn->query($sql_users);

    // Check if the username exists in the users table
    if ($result_users->num_rows > 0) {
        $user = $result_users->fetch_assoc();

        // Step 2: Verify password for users (admin, customer)
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on user role
            if ($user['role'] === 'admin') {
                header("Location: homepage.php");
            } elseif ($user['role'] === 'customer') {
                header("Location: customer_home.php");
            } else {
                header("Location: homepage.php");
            }
            exit();
        } else {
            echo "<script>
                alert('Invalid password for admin/customer.');
                window.location.href = 'login.php';
                </script>";
        }
    }
   // Step 3: Check in the 'ladies' table for staff (ladies)
else {
    // SQL query to select the lady based on the username (name)
    $sql_ladies = "SELECT * FROM ladies WHERE name='$username'";
    $result_ladies = $conn->query($sql_ladies);

    // Check if the username exists in the ladies table
    if ($result_ladies->num_rows > 0) {
        $lady = $result_ladies->fetch_assoc();

        // Step 4: Verify password for ladies
        if (password_verify($password, $lady['password'])) {
            // Start session and set session variables for the logged-in lady
            $_SESSION['name'] = $lady['name'];
            $_SESSION['role'] = 'ladies';  // Set role as 'ladies'
            $_SESSION['ladies_id'] = $lady['id'];
            $_SESSION['ladies_name'] = $lady['name'];
            $_SESSION['ladies_photo_url'] = $lady['photo_url'];
            $_SESSION['ladies_package_type'] = $lady['package_type'];
            $_SESSION['ladies_package_details'] = $lady['package_details'];
            $_SESSION['ladies_experience'] = $lady['experience'];
            $_SESSION['ladies_age'] = $lady['age'];
            $_SESSION['ladies_specialty'] = $lady['specialty'];
            $_SESSION['ladies_bio'] = $lady['bio'];
            $_SESSION['ladies_contact_info'] = $lady['contact_info'];

            // Redirect to staff profile page
            header("Location: staff_profile.php");
            exit();
        } else {
            // Incorrect password
            echo "<script>
                alert('Invalid password for lady.');
                window.location.href = 'login.php';
                </script>";
        }
    } else {
        // Username not found
        echo "<script>
            alert('No user found with this username.');
            window.location.href = 'login.php';
            </script>";
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
            background: url('images/log-in.jpg')
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
<body>

<div class="container">
    <div class="image-section"></div>

    <div class="form-section">
        <div class="logo">
            <img src="images/logo.png" style="margin-top: 50px;" alt="Logo">
        </div>

        <h1>Login Form</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Login</button>
        </form>

        <div class="footer">
            <a href="password.php">Forgot Password?</a><br><br>
            Don't have an account? <a href="signup.php">Register</a>
        </div>
    </div>
</div>

</body>
</html>
