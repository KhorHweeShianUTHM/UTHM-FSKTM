<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <link rel="stylesheet" href="styles.css">

  <style>
    /* styles.css */

body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: linear-gradient(to right, #000428, #004e92);
  color: #fff;
}

.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
}

.header {
  position: absolute;
  top: 0;
  width: 100%;
  display: flex;
  justify-content: space-between;
  padding: 10px 20px;
  background-color: #5c9cc6;
}

.logo h1 {
  margin: 0;
  color: #fff;
}

.nav a {
  text-decoration: none;
  color: #fff;
  font-weight: bold;
}

.main-content {
  text-align: center;
  padding: 20px;
}

.form-section {
  background-color: rgba(255, 255, 255, 0.1);
  border-radius: 15px;
  padding: 20px;
  width: 100%;
}

h2 {
  margin-bottom: 20px;
  font-size: 24px;
}

.password-form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.input-field {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  border: none;
  border-radius: 20px;
  text-align: center;
  background: #fff;
  color: #000;
}

.input-field:focus {
  outline: none;
  border: 2px solid #5c9cc6;
}

.submit-btn {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  border: none;
  border-radius: 20px;
  background: #5c9cc6;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
}

.submit-btn:hover {
  background: #004e92;
}

.form-links {
  margin-top: 10px;
}

.form-links a {
  display: block;
  color: #c2dfff;
  text-decoration: none;
}

.form-links a:hover {
  text-decoration: underline;
}

  </style>
</head>
<body>
  <div class="container">
    <header class="header">
      <div class="logo">
        <h1>KCCC</h1>
      </div>
      <nav class="nav">
        <a href="homepage.php">Home</a>
      </nav>
    </header>
    <main class="main-content">
      <div class="form-section">
        <h2>Reset Password</h2>
        <form class="password-form">
          <input type="password" placeholder="New Password" class="input-field" required>
          <input type="password" placeholder="Confirm New Password" class="input-field" required>
        </form>
        <form action="login.php" method="post" style="display: inline;">
            <input type="submit" class="submit-btn" value="Submit">
        </form>
        <form action="login.php" method="post" style="display: inline;">
            <input type="submit" class="submit-btn" value="Cancel">
        </form>
      </div>
    </main>
  </div>
</body>
</html>
