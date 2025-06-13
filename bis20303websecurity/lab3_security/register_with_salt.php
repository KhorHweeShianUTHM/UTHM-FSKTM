<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$conn = new mysqli("localhost", "root", "", "lab3_security");

$username = $_POST['username'];
$password = $_POST['password'];
$salt = bin2hex(random_bytes(16));
$password_hash = hash('sha256', $password . $salt);

$sql = "INSERT INTO users_with_salt (username, salt, password_hash) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $salt, $password_hash);
$stmt->execute();

echo "User registered with salt.";

$stmt->close();
$conn->close();
}
?>

<form action="" method="POST">
    <h3>Register with SALT</h3>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Register">
</form>