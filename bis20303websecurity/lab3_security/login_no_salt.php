<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$conn = new mysqli("localhost", "root", "", "lab3_security");

$username = $_POST['username'];
$password = $_POST['password'];
$password_hash = sha1($password); // Hash entered password

$sql = "SELECT * FROM users_no_salt WHERE username = ? AND password_hash = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password_hash);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Login Successful.";
} else {
    echo "Invalid Credentials.";
}

$stmt->close();
$conn->close();
}
?>

<form action="" method="POST">
    <h3>Login without SALT</h3>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Login">
</form>