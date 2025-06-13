<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KangarooCare Confinement Centre</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        header {
            background-color: #00274d;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header img {
            width: 150px;
            margin-right: 15px;
        }

        header .header-title {
            display: flex;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .nav-links {
            display: flex;
            gap: 15px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-links a:hover {
            background-color: #f4a261;
        }
    </style>
</head>
<body>

<header>
    <div class="header-title">
        <img src="images/kangaroo-logo.png" alt="Logo">
        <h1>KangarooCare Confinement Centre</h1>
    </div>
    <nav class="nav-links">
        <a href="booking.php">Booking</a>
        <a href="guide.php">Guide</a>
        <a href="service_distinct">Services</a>
        <a href="feedback.php">Feedback</a>
    </nav>
</header>
