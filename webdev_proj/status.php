<?php
include 'db.php';

if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    $query = "SELECT approval_status FROM bookings WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$booking_id]);
    $booking = $stmt->fetch();

    if ($booking) {
        echo "<div class='status-message'>Your booking status is: <strong>" . $booking['approval_status'] . "</strong></div>";
    } else {
        echo "<div class='status-message error'>Booking not found.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Booking Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #89CFF0, #1E1E6D);
            color: #333;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .header {
            background-color: #1E1E6D;
            color: #fff;
            padding: 10px 0;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .status-form {
            margin-top: 20px;
        }

        .status-form input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .status-form input[type="text"]:focus {
            border-color: #1E1E6D;
            outline: none;
        }

        .status-form button {
            background: #1E1E6D;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .status-form button:hover {
            background: #333;
        }

        .status-message {
            margin-top: 20px;
            padding: 10px;
            background: #e9ffe9;
            border: 1px solid #b3ffb3;
            border-radius: 5px;
            color: #1a7f1a;
            font-weight: bold;
        }

        .status-message.error {
            background: #ffe9e9;
            border: 1px solid #ffb3b3;
            color: #7f1a1a;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Check Your Booking Status</h1>
        </div>

        <form class="status-form" method="get">
            <input type="text" name="booking_id" placeholder="Enter Booking ID" required>
            <button type="submit">Check Status</button>
        </form>
    </div>
</body>
</html>
