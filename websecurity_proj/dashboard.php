<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      margin: 0;
      padding: 0;
    }
    .header {
        background: #4CAF50;
        color: white;
        padding: 15px;
        text-align: center;
    }
    .logout {
        display: inline-block;
        text-decoration: none;
        font-weight: bold;
        margin-top: 20px;
        margin-left: 20px;
    }
    .logout:hover {
        text-decoration: underline;
    }
    .container {
      background: #fff;
      margin: 30px auto;
      padding: 30px;
      max-width: 600px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="header">
    <h2>Welcome to the Dashboard</h2>
  </div>

  <a href="logout.php" class="logout">Logout</a>

  <div class="container">
    <h3>Hello, <?= htmlspecialchars($_SESSION['name'] ?? 'User') ?>!</h3>
    <p>You are now logged in.</p>
  </div>
  
</body>
</html>