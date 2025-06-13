<?php
// Database connection
require_once 'config/db.php';
require_once 'config/auth.php'; 

// Get the lady ID from URL
$id = $_GET['id'];

// Query to get the lady's full profile based on the ID
$sql = "SELECT * FROM ladies WHERE id = $id";
$result = $conn->query($sql);
$lady = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lady['name']; ?>'s Profile</title>
    <style>
        
body {
    margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #0a0f44, #5a9bd6);
            color: #333;
}

/* Header styling */
header {
    background-color: #00274d;
            color: white;
            padding: 60px;
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

        footer {
            background-color: #00274d;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }

        footer .social-links {
            margin-top: 10px;
        }

        footer .social-links a {
            color: #f4a261;
            text-decoration: none;
            margin: 0 10px;
            font-size: 16px;
        }

        footer .social-links a:hover {
            text-decoration: underline;
        }

      .lady-details {
    max-width: 800px;
    margin: 2rem auto;
    background-color: #fff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.lady-details h2 {
    font-size: 2.5rem;
    color: #343a40;
    margin-bottom: 1.5rem;
    text-align: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
}

.lady-details img {
    display: block;
    margin: 0 auto 1.5rem;
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.lady-details p {
    font-size: 1.2rem;
    margin-bottom: 1rem;
    font-family: Georgia, 'Times New Roman', Times, serif
}

.lady-details p strong {
    color: #6c757d;
    font-weight: bold;
    font-family: Georgia, 'Times New Roman', Times, serif;
}

.lady-details a {
    display: inline-block;
    margin: 1rem 0;
    background-color: #1a4f88;
    color: #fff;
    padding: 0.8rem 2rem;
    font-size: 1.2rem;
    text-decoration: none;
    border-radius: 50px;
    transition: background-color 0.3s ease;
    text-align: center;
}

.lady-details a:hover {
    background-color: #f31111;
}

/* Responsive styling */
@media (max-width: 768px) {
    header h1 {
        font-size: 2rem;
    }

    .lady-details {
        padding: 1.5rem;
    }

    .lady-details h2 {
        font-size: 2rem;
    }

    .lady-photo {
        height: 150px;
    }

    a {
        padding: 0.8rem 1.5rem;
    }
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
        <a href="service_distinct.php">Services</a>
        <a href="feedback.php">Feedback</a>
    </nav>
    </header>

    <section class="lady-details">
        <h2><?php echo $lady['name']; ?></h2>
        <img src="image/<?php echo $lady['photo_url']; ?>" alt="Photo of <?php echo $lady['name']; ?>" class="lady-photo">
        <p><strong>Experience:</strong> <?php echo $lady['experience']; ?> years</p>
        <p><strong>Specialty:</strong> <?php echo $lady['specialty']; ?></p>
        <p><strong>Package Type:</strong> <?php echo $lady['package_type']; ?></p>
        <p><strong>Package Details:</strong> <?php echo $lady['package_details']; ?></p>
        <p><strong>Bio:</strong> <?php echo $lady['bio']; ?></p>
        <p><strong>Contact Info:</strong> <?php echo $lady['contact_info']; ?></p>
        <p><strong>Price:</strong> RM<?php echo $lady['price']; ?></p>
        <a href="booking.php?id=<?php echo $lady['id']; ?>">Book Now</a>
    </section>
    <footer>
    &copy; 2025 KangarooCare | <a href="#" style="color: #f4a261;">Privacy Policy</a>
    <div class="social-links">
        <a href="https://facebook.com">Facebook</a>
        <a href="https://instagram.com">Instagram</a>
    </div>
</footer>
</body>
</html>

<?php
$conn->close();
?>
