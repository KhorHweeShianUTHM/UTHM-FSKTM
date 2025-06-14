<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    padding: 20px;
  }

  .container {
    max-width: 400px;
    margin: 0 auto;
    background-color: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
  }

  h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }

  label {
    display: block;
    margin-top: 15px;
    color: #333;
    font-weight: bold;
  }

  input[type="text"],
  input[type="password"],
  input[type="email"] {
    width: 95%;
    padding: 8px 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
  }

  .error {
    color: red;
    font-size: 13px;
    margin-bottom: 5px;
    display: none;
  }

  button[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-top: 20px;
    background-color: #4CAF50;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
  }

  button[type="submit"]:hover {
    background-color:#429145;
  }
  </style>
</head>
<body>
  <div class="container">
    <h2>User Login</h2>
    <?php
      session_start();
      $num1 = rand(1, 10);
      $num2 = rand(1, 10);
      $_SESSION['captcha'] = $num1 + $num2;
    ?>
    <?php if (isset($_GET['error'])): ?>
      <p class="error"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <form action="loginChecked.php" method="POST" onsubmit="return validateForm()">
      
      <label>User ID</label>
      <input type="text" name="userid" id="userid">
       <div id="useridError" class="error">User ID is required</div> <!-- Display suitable error message -->

      <label>Password</label>
      <input type="password" name="password" id="password">
      <div id="passwordError" class="error"></div> <!-- Display suitable error message -->

      <label>Security Phrase</label>
      <input type="text" name="security_phrase" id="security_phrase">
      <div id="securityphraseError" class="error"></div> <!-- Display suitable error message -->

      <label>Solve: <?= "$num1 + $num2 = ?" ?></label>
      <input type="text" name="captcha" id="captcha">
      <div id="captchaError" class="error"></div> <!-- Display suitable error message -->

      <button type="submit">Login</button>
    </form>
    <p style="text-align:center; margin-top:15px;">
      <a href="register.html">Not registered? Register here</a>
    </p>
  </div>

<script>
function validateForm() {
  let isValid = true;

  const userid = document.getElementById("userid").value.trim();
  const password = document.getElementById("password").value.trim();
  const security_phrase = document.getElementById("security_phrase").value.trim();
  const captcha = document.getElementById("captcha").value.trim();

  document.querySelectorAll(".error").forEach(e => e.style.display = "none");

  // UserID validation
  if (userid === "") {
    document.getElementById("useridError").style.display = "block";
    isValid = false;
  }

  // Password strength validation
  if (password === "") {
    document.getElementById("passwordError").innerText = "Password is required.";
    document.getElementById("passwordError").style.display = "block";
    isValid = false;
  }

  // Validate security phrase
  if (security_phrase === "") {
    document.getElementById("securityphraseError").innerText = "Security phrase is required.";
    document.getElementById("securityphraseError").style.display = "block";
    isValid = false;
  }

  // Validate captcha
  if (captcha === "") {
    document.getElementById("captchaError").innerText = "Please solve the captcha.";
    document.getElementById("captchaError").style.display = "block";
    isValid = false;
  } else if (isNaN(captcha)) {
    document.getElementById("captchaError").innerText = "Captcha must be a number.";
    document.getElementById("captchaError").style.display = "block";
    isValid = false;
  }
  
  return isValid;
}
</script>
</body>
</html>