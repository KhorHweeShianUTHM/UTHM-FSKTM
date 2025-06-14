<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add your database connection logic here

    // Retrieve user input
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phonenum = $_POST['phonenum'];
	$address = $_POST['address'];
	
    // Check if the passwords match
    if ($_POST['password'] !== $_POST['confirm_password']) {
        echo "<script>alert('Passwords do not match.');</script>";
        echo '<script>
        setTimeout(function(){
            window.location.href = "user-register.php";
        }, 200); 
      </script>';
    }

    // Perform database insertion (replace with your own logic)
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "swiss_collection";

    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Note: Storing plain text passwords is not recommended for security reasons
    $sql = "INSERT INTO users (first_name, last_name, email, address, phonenum, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $first_name, $last_name, $email, $address, $phonenum, $password);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    // Redirect to the login page
    header("Location: user-login.php");
    exit();
}
?>

<!DOCTYPE html>
<html class="h-100" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register - Caffeine & Calories by Gastro Scholar</title>
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
								<a class="text-center" href=""> <h5>- User Register -</h5></a><br>
								<form method="post" class="mt-5 mb-5 login-input">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                                    </div>
									<div class="form-group">
                                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                                    </div>
									<div class="form-group">
                                        <input type="text" class="form-control"  name="phonenum" placeholder="Phone number" required>
                                    </div>
									<div class="form-group">
                                        <input type="text" class="form-control"  name="address" placeholder="Address" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control"  name="email" placeholder="Email" required>
                                    </div>
                                    <div class="form-group" style="position: relative;">
										<input type="password" class="form-control" name="password" id="passwordInput" placeholder="Password" pattern="[a-zA-Z0-9@!$]{8,20}" title="Password must contain alphanumeric characters and @!$ symbol (max 20 characters)" required>
										<span class="eye toggle-password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"><i class="fa fa-eye-slash"></i></span>
									</div>
									<div class="form-group" style="position: relative;">
										<input type="password" class="form-control" name="confirm_password" id="confirmpasswordInput" placeholder="Confirm Password" pattern="[a-zA-Z0-9@!$]{8,20}" title="Password must contain alphanumeric characters and @!$ symbol (max 20 characters)" required>
										<span class="eye toggle-confirmpassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"><i class="fa fa-eye-slash"></i></span>
									</div><br>
                                    <button class="btn login-form__btn submit w-100">Register</button>
                                </form>
                                <p class="mt-5 login-form__footer">Have account ? <a href="user-login.php" class="text-primary">Sign In </a> now</p>
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
	<script src="js/password1.js"></script>
	<script src="js/password2.js"></script>
</body>
</html>