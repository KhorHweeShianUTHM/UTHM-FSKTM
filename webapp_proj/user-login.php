<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add your database connection logic here

    // Retrieve user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform database query to check user credentials (replace with your own logic)
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "swiss_collection";

    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Set up user session (you may include more user details in the session)
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        // Redirect to user profile page
        header("Location: user-profile.php");
        exit();
    } else {
        echo "<script>alert('Invalid email or password.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html class="h-100" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - Caffeine & Calories by Gastro Scholar</title>
	<link rel="shortcut icon" type="x-icon" href="images/logo_1.ico"/>
	<link rel="stylesheet" href="css/userLogin.css">
	
</head>

<body class="h-100">

    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href=""> <h4>CAFFEINE & CALORIES</h4></a>
								<a class="text-center" href=""> <h5>- User Login -</h5></a><br>
								<form method="post">
                                <form class="mt-5 mb-5 login-input">
                                    <div class="form-group">
                                       <input type="email" class="form-control"  name="email" placeholder="Email" required>
                                    </div><br>
                                     <div class="form-group" style="position: relative;">
										<input type="password" class="form-control" name="password" id="passwordInput" placeholder="Password" pattern="[a-zA-Z0-9@!$]{8,20}" title="Password must contain alphanumeric characters and @!$ symbol (max 20 characters)" required>
										<span class="eye toggle-password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"><i class="fa fa-eye-slash"></i></span>
									</div><br>
                                    <button class="btn login-form__btn submit w-100">Sign in</button>
                                </form>
                                <p class="mt-5 login-form__footer">Dont have account ? <a href="user-register.php" class="text-primary">Sign Up </a> now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
	<script src="js/password.js"></script>
	
</body>
</html>