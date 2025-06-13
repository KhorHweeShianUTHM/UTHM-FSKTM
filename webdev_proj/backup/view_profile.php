<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webdev";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
        
/* Body styling */
body {
    font-family: Georgia, 'Times New Roman', Times, serif;
    background: linear-gradient(to right, #000428, #004e92);
    color: #333;
    line-height: 1.6;
}

/* Header styling */
header {
    background: linear-gradient(to right, #000428, #004e92); /* Matching the existing gradient background */
    color: #fff; /* Light text to stand out on the dark background */
    text-align: center;
    padding: 1rem; /* Increased padding for more space */
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); /* Subtle shadow for a sense of depth */
    border-radius: 15px; /* Rounded corners for a smoother feel */
    font-family: Georgia, 'Times New Roman', Times, serif /* Clean, modern font */
}

header h1 {
    font-size: 3rem; /* Larger size for emphasis */
    font-weight: bold;
    color: #fff; /* White text to contrast with the dark background */
    letter-spacing: 1.5px;
    text-transform: uppercase; /* Uppercase for a modern, impactful look */
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
        <h1>Confinement Lady Profile</h1>
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
        <a href="booking.php?id=<?php echo $lady['id']; ?>">Book Now</a>
    </section>

</body>
</html>

<?php
$conn->close();
?>
