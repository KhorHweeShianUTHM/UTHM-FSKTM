<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kangaroocare";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$paymentStatus = ''; // Variable to hold success or error message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Capture form data from POST request
  $cardType = $_POST['cardType'];
  $cardNumber = $_POST['cardNumber'];  
  $cardName = $_POST['cardName'];
  $expiryDate = $_POST['expiryDate'] . '-01'; // Add day "01" to the month-year format
  $cw = $_POST['cw'];
  $selectedPackage = $_POST['selectedPackage'];
  $totalPrice = $_POST['totalPrice'];
  $userId = $_POST['userId'];

  // Validation: Check if all fields are filled
if (empty($cardType) || empty($cardNumber) || empty($cardName) || empty($expiryDate) || empty($cw) || empty($selectedPackage) || empty($totalPrice) || empty($userId)) {
  $paymentStatus = "Please fill all fields before submitting.";
} elseif (!preg_match('/^\d{16}$/', $cardNumber)) { // Validate card number
  $paymentStatus = "Please enter a valid 16-digit card number.";
} elseif (!preg_match('/^[a-zA-Z\s]+$/', $cardName)) { // Validate card name (only letters and spaces)
  $paymentStatus = "Card name can only contain letters and spaces.";
} else {
  // Prepare SQL statement to insert data
  $sql = "INSERT INTO payments (card_type, card_number, card_name, expiry_date, cw, selected_package, total_price, user_id)
          VALUES ('$cardType', '$cardNumber', '$cardName', '$expiryDate', '$cw', '$selectedPackage', '$totalPrice', '$userId')";

  if ($conn->query($sql) === TRUE) {
    $paymentStatus = "Payment recorded successfully!";
  } else {
    $paymentStatus = "Error: " . $sql . "<br>" . $conn->error;
  }
}
// Close connection
$conn->close();

  
  // Send back a response with the status
  echo $paymentStatus;
  exit();  // Stop further processing
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <title>Payment Page</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to bottom, #0a0f44, #5a9bd6);
    }

    .container {
      display: flex;
      justify-content: space-between;
      padding: 50px;
    }

    .left-column {
      flex: 0 0 60%;
      background-color: #ECECEC;
      padding: 30px;
    }

    .right-column {
      flex: 0 0 35%;
      background-color: #ECECEC;
      padding: 30px;
    }

    .inner-box-1 {
      background-color: #FAFAFA;
      border-radius: 10px;
      padding: 20px;
    }

    .btn-package {
      margin: 5px;
      font-size: 14px;
      padding: 8px 20px;
      border-radius: 25px;
      border: 2px solid #6c757d;
      background-color: #f8f9fa;
      color: #6c757d;
      transition: all 0.3s ease;
    }

    .btn-package:hover {
      background-color: #007bff;
      color: white;
      border-color: #007bff;
    }

    .btn-active {
      background-color: #007bff !important;
      color: white !important;
      border-color: #007bff !important;
    }

    .total-price-box {
      margin-top: 20px;
      padding: 20px;
      border-radius: 10px;
      background-color: #f8f9fa;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .order-summary-button {
      width: 100%;
      margin-top: 20px;
      padding: 15px;
      font-size: 18px;
    }

    /* Centering the payment status message */
    #payment-status-message {
      padding: 20px;
      background-color: #e0ffe0;
      color: green;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border-radius: 10px;
      text-align: center;
      display: none;
      z-index: 1000; /* Ensure it appears on top */
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
      width: 60%;
      max-width: 400px;
    }

    /* Dim the background when popup appears */
    #overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.4);
      display: none;
      z-index: 500;
    }

  </style>
</head>
<body>
  <div class="container">
    <div class="left-column">
      <div class="inner-box-1">
        <div class="header">
          <img src="logo.png" alt="Logo">
        </div>
        <h1>Payment details</h1>
        <form method="POST" id="payment-form">
          <div class="mb-3">
            <label for="cardType" class="form-label">Card Type</label>
            <select class="form-select" id="cardType" name="cardType" required>
              <option value="" selected disabled>Select card type</option>
              <option value="visa">Visa</option>
              <option value="mastercard">MasterCard</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="cardNumber" class="form-label">Card Number</label>
            <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" required>
          </div>
          <div class="mb-3">
            <label for="cardName" class="form-label">Name on Card</label>
            <input type="text" class="form-control" id="cardName" name="cardName" placeholder="John Doe" required>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="expiryDate" class="form-label">Expiry Date</label>
              <input type="month" class="form-control" id="expiryDate" name="expiryDate" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="cw" class="form-label">CW</label>
              <input type="text" class="form-control" id="cw" name="cw" placeholder="123" maxlength="4" required>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="right-column">
      <h1>Order Summary</h1><br>
      <div class="order-summary-container" style="border: 2px solid #ADD8E6; border-radius: 10px; padding: 20px; background-color: white">
        <div class="package-selection">
          <h2 style="font-size: 24px; text-align: left;">Package Type</h2>
          <button class="btn btn-package" onclick="updateTotal('basic', this)">Basic</button>
          <button class="btn btn-package" onclick="updateTotal('premium', this)">Premium</button>
        </div>
        <div class="total-price-box">
          <h1>Total Price</h1>
          <span id="totalPrice" style="font-size: 20px; color: #007bff;">RM 0.00</span>
        </div>
        <button type="button" class="btn btn-primary order-summary-button" onclick="submitPayment(event)">Submit Payment</button>
      </div>
    </div>
  </div>

  <!-- Overlay and Payment Status Message -->
  <div id="overlay"></div>
  <div id="payment-status-message">Payment Successfully!!!</div>

  <script>
    function updateTotal(packageType, button) {
      // Mark the selected button as active
      const buttons = document.querySelectorAll('.btn-package');
      buttons.forEach(btn => btn.classList.remove('btn-active'));

      button.classList.add('btn-active');
      
      // Update the total price based on selected package
      const totalPriceElement = document.getElementById('totalPrice');
      if (packageType === 'basic') {
        totalPriceElement.textContent = 'RM 500.00';
      } else {
        totalPriceElement.textContent = 'RM 800.00';
      }
    }

    function validateCardNumber(cardNumber) {
      const cardNumberPattern = /^[0-9]{16}$/; // Only 16 digits allowed
      return cardNumberPattern.test(cardNumber);
    }

    function submitPayment(event) {
      event.preventDefault();  // Prevent form submission (default behavior)

      const cardType = document.getElementById('cardType').value;
      const cardNumber = document.getElementById('cardNumber').value;
      const cardName = document.getElementById('cardName').value;
      const expiryDate = document.getElementById('expiryDate').value;
      const cw = document.getElementById('cw').value;
      const selectedPackage = document.querySelector('.btn-active');
      
      // Check if any field is empty
      if (!cardType || !cardNumber || !cardName || !expiryDate || !cw || !selectedPackage) {
        alert('Please fill all fields before submitting.');
        return; // Prevent submission if any field is empty
      }

      // Validate card number
      if (!validateCardNumber(cardNumber)) {
        alert('Please enter a valid 16-digit card number.');
        return; // Prevent submission if card number is invalid
      }

      // Validate card number
if (!validateCardNumber(cardNumber)) {
  alert('Please enter a valid 16-digit card number.');
  return; // Prevent submission if card number is invalid
}

// Validate card name
if (!validateCardName(cardName)) {
  alert('Card name can only contain letters and spaces.');
  return; // Prevent submission if card name is invalid
}

// Function to validate card number
function validateCardNumber(cardNumber) {
  const cardNumberRegex = /^\d{16}$/; // Must be exactly 16 digits
  return cardNumberRegex.test(cardNumber);
}

// Function to validate card name
function validateCardName(cardName) {
  const cardNameRegex = /^[a-zA-Z\s]+$/; // Only letters and spaces allowed
  return cardNameRegex.test(cardName);
}


      // Proceed with payment submission if all fields are filled and valid
      const paymentData = {
        cardType: cardType,
        cardNumber: cardNumber,
        cardName: cardName,
        expiryDate: expiryDate,
        cw: cw,
        selectedPackage: selectedPackage.innerText,
        totalPrice: selectedPackage.innerText === 'Basic' ? 500.00 : 800.00,  // Send numeric value
        userId: 123 // Or dynamically get the user ID if the user is logged in
      };

      // Send the data using AJAX (using Fetch API)
      fetch('', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams(paymentData)
      })
      .then(response => response.text())
      .then(data => {
        // Show overlay and message popup
        document.getElementById('overlay').style.display = 'block';
        document.getElementById('payment-status-message').style.display = 'block';

        setTimeout(function() {
          // Hide the overlay and message after 5 seconds
          document.getElementById('overlay').style.display = 'none';
          document.getElementById('payment-status-message').style.display = 'none';
        }, 5000);
      });
    }
  </script>
</body>
</html> 