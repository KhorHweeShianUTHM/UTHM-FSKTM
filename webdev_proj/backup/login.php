<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: homepage.php");
    exit;
}

if (isset($_SESSION["changepassword"]) && $_SESSION["changepassword"] === true) {
    header("location: password.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: homepage.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            font-family: 'ITCBenguiat';
            height: 100vh;
            background: linear-gradient(to right, #000000, #3533CD);
            color: #fff;
        }

       .logo-container {
	display: flex;
	align-items: center;
	justify-content: center; /* To center horizontally */
	height: 200px; /* Set the height to the full viewport height for vertical centering */
        }

       .logo {
                width: 600px;
                height: 400px;
        }

        .kangaroo-care {
            text-align: center;
            font-size: 50px;
            line-height: 1;
            text-shadow: 0 0 5px rgba(202, 144, 73, 0.8), 0 0 10px rgba(202, 144, 73, 10.6), 0 0 15px rgba(202, 144, 73, 0.4);
            background: linear-gradient(to right, #ca9049, #fff, #ca9049);
            -webkit-background-clip: text;
            color: transparent;
            display: inline-block;
            margin-bottom: 10px;
        }

        .wrapper {
            height: auto;
            width: 450px;
            padding: 20px;
        }

        .input-field {
  width: 250px;
  padding: 10px;
  margin: 10px 0;
  border: none;
  border-radius: 20px;
  text-align: center;
}

.input-field:focus {
  outline: none;
  border: 2px solid #5c9cc6;
}

.form-group {
    align-items: center;
    justify-content: center;
    display: flex;
}

.form-links {
  margin-top: 10px;
  align-items: center;
    justify-content: center;
    display: flex;
}

.form-links a {
  display: block;
  margin: 5px 0;
  color: #c2dfff;
  text-decoration: none;
}

</style>
</head>
<body>
    <div class="wrapper">
	
	<div class="kangaroo-care">  Kangaroo Care Confinement Centre </div>
                  <div class="logo-container">
	<img class="logo" src="kclogo.png" alt="Your Logo"></img>
	</div>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                
                <input type="text" placeholder="USERNAME" name="username" class="input-field" required <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                
                <input type="password" placeholder="PASSWORD" name="password" class="input-field" required <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            </form>
            
            <div class="form-links">
            <!-- Forgot Password Button -->
            <form action="password.php" method="get" style="display: inline;">
                <input type="submit" class="btn btn-secondary" value="Forgot Password?">
            </form>

            <!-- Sign Up Button -->
            <form action="signup.php" method="get" style="display: inline;">
            <input type="submit" class="btn btn-secondary" value="Sign up now">
            </form>
            </div>
    </div>
</body>
</html>