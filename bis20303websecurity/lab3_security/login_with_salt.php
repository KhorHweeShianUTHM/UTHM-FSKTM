<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$conn = new mysqli("localhost", "root", "", "lab3_security");

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT salt, password_hash FROM users_with_salt WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if($row = $result->fetch_assoc()) {
    $salt = $row['salt'];
    $password_hash = hash('sha256', $password . $salt);

    if($password_hash === $row['password_hash']) {
        echo "Login Successful.";
    } else {
        echo "Invalid Credentials";
    }
} else {
    echo "User not found.";
}

$stmt->close();
$conn->close();
}
?>

<form action="" method="POST">
    <h3>Login with SALT</h3>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Login">
</form>