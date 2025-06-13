<?php
// Database connection
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "webdev"; // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
    padding: 2rem 0; /* Increased padding for more space */
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
        <h1>Meet Our Confinement Ladies</h1>
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
                            <button onclick="window.location.href='view_profile.php?id=<?php echo $lady['id']; ?>'">View Profile</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </main>
</body>
</html>

<?php
$conn->close();
?>

