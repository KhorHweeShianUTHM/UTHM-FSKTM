<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$conn = new mysqli("localhost", "root", "", "lab3_security");

$username = $_POST['username'];
$password = $_POST['password'];
$password_hash = sha1($password); // No salt

$sql = "INSERT INTO users_no_salt (username, password_hash) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password_hash);
$stmt->execute();

echo "User registered without salt.";

$stmt->close();
$conn->close();
}
?>

<form action="" method="POST">
    <h3>Register without SALT</h3>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Register">
</form>