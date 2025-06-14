<?php
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$position = $_POST['position'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirmpassword = $_POST['confirmpassword'] ?? '';
$is_admin = isset($_POST['is_admin']) ? 1 : 0; // Check if admin checkbox is checked
$errorMsg = [];

// Check if any required fields are empty or contain only whitespace
if (empty($first_name) || empty($last_name) || empty($position) || empty($email) || empty($password) || empty($confirmpassword)
    || ctype_space($first_name) || ctype_space($last_name) || ctype_space($position) || ctype_space($email) || ctype_space($password) || ctype_space($confirmpassword)) {
    $errorMsg[] = "All fields are required.";
}

// Check if password and confirm password match
if ($password !== $confirmpassword) {
    $errorMsg[] = "Passwords do not match.";
}

// Validate password complexity
if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@!$])[a-zA-Z\d@!$]{8,20}$/', $password)) {
    $errorMsg[] = "Password must contain at least one lowercase letter, one uppercase letter, one number, one special character (@, !, $), and be 8-20 characters long.";
}

// Validate email format
if (strpos($email, '@') === false) {
    $errorMsg[] = "Please enter a valid email address.";
}

// Display errors using JavaScript alert or redirect back with errors
if (!empty($errorMsg)) {
    echo "<script>alert('" . implode("\\n", $errorMsg) . "');</script>";
    echo "<script>window.history.back();</script>";
    exit(); // Stop further execution if there are errors
}

// Database connection and insertion
$conn = new mysqli('localhost', 'root', '', 'swiss_collection');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
} else {

    // Insert user without storing confirm password in the database
    $stmt = $conn->prepare("INSERT INTO adminlogin (first_name, last_name, position, email, password, is_admin) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $first_name, $last_name, $position, $email, $password, $is_admin);
    $stmt->execute();
    $stmt->close();

    // Redirect to login page after successful registration
    header("Location: page-login.html");
    exit();
}

if (!empty($errorMsg)) {
    echo "<script>alert('" . implode("\\n", $errorMsg) . "');</script>";
    echo "<script>window.history.back();</script>";
    exit(); // Stop further execution if there are errors
} else {
    // Inform the user about the approval requirement
    echo "<script>alert('Your registration is pending admin approval. You will receive an email once approved.');</script>";
    echo "<script>window.location = '/path/to/waiting-page.html';</script>";
    exit();
}	
?>
