<?php
// Database connection
require_once 'config/db.php';
require_once 'config/auth.php'; 

// Query to get Basic package ladies
$sql_basic = "SELECT * FROM ladies WHERE package_type = 'Basic'";
$result_basic = $conn->query($sql_basic);

// Query to get Premium package ladies
$sql_premium = "SELECT * FROM ladies WHERE package_type = 'Premium'";
$result_premium = $conn->query($sql_premium);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confinement Ladies</title>
    <style>
        /* General reset for all elements */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styling */
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


/* Main container */
.container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

/* Package section */
.package-section h2 {
    font-size: 2rem;
    text-align: center;
    color: #ffffff;
    margin-bottom: 2rem;
    margin-top: 2rem; 
}

/* Ladies list */
.ladies-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

/* Lady card styling */
.lady-card {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.lady-card:hover {
    transform: scale(1.03);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

/* Lady photo */
.lady-photo {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

/* Lady info */
.lady-info {
    padding: 1rem;
    text-align: center;
}

.lady-info h3 {
    font-size: 1.5rem;
    color: #343a40;
    margin-bottom: 0.5rem;
}

.lady-info p {
    font-size: 1rem;
    color: #555;
    margin-bottom: 0.5rem;
}

/* Button styling */
.lady-info button {
    background-color: #1a4f88;
    color: #fff;
    padding: 0.7rem 1.5rem;
    font-size: 1rem;
    border-radius: 25px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
    font-weight: bold;
    font-family: Georgia, 'Times New Roman', Times, serif;
}

.lady-info button:hover {
    background-color: #7da6b1;
    transform: scale(1.05);
}

/* Responsive styling */
@media (max-width: 768px) {
    header h1 {
        font-size: 2rem;
    }

    .package-section h2 {
        font-size: 1.5rem;
    }

    .lady-info h3 {
        font-size: 1.2rem;
    }

    .lady-info button {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
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

    <main class="container">
        <section class="package-section">
            <h2>Basic Package</h2>
            <div class="ladies-list">
                <?php while ($lady = $result_basic->fetch_assoc()) { ?>
                    <div class="lady-card">
                        <img src="image/<?php echo $lady['photo_url']; ?>" alt="Photo of <?php echo $lady['name']; ?>" class="lady-photo">
                        <div class="lady-info">
                            <h3><?php echo $lady['name']; ?></h3>
                            <p><strong>Experience:</strong> <?php echo $lady['experience']; ?> years</p>
                            <p><strong>Package:</strong> <?php echo $lady['package_type']; ?></p>
                            <p><strong>Details:</strong> <?php echo $lady['package_details']; ?></p>
                            <p><strong>Price:</strong>  RM <?php echo $lady['price']; ?></p>
                            <button onclick="window.location.href='view_profile.php?id=<?php echo $lady['id']; ?>'">View Profile</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>

        <section class="package-section">
            <h2>Premium Package</h2>
            <div class="ladies-list">
                <?php while ($lady = $result_premium->fetch_assoc()) { ?>
                    <div class="lady-card">
                        <img src="image/<?php echo $lady['photo_url']; ?>" alt="Photo of <?php echo $lady['name']; ?>" class="lady-photo">
                        <div class="lady-info">
                            <h3><?php echo $lady['name']; ?></h3>
                            <p><strong>Experience:</strong> <?php echo $lady['experience']; ?> years</p>
                            <p><strong>Package:</strong> <?php echo $lady['package_type']; ?></p>
                            <p><strong>Details:</strong> <?php echo $lady['package_details']; ?></p>
                            <p><strong>Price:</strong> RM <?php echo $lady['price']; ?></p>
                            <button onclick="window.location.href='view_profile.php?id=<?php echo $lady['id']; ?>'">View Profile</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </main>
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

