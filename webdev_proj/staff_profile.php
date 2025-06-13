<?php
session_start(); // Start the session to access session variables

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kangaroocare";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in by verifying the session variable for 'ladies_id'
if (!isset($_SESSION['ladies_id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Fetch the logged-in lady's ID from the session
$ladies_id = $_SESSION['ladies_id'];

// Fetch user's profile information from the database
$sql = "SELECT * FROM ladies WHERE id = $ladies_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the user data
    $ladies = $result->fetch_assoc();
} else {
    echo "Profile not found.";
    exit;
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <style>
        /* General styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        header {
            background: linear-gradient(to right, #000428, #004e92);
            color: white;
            padding: 1rem;
            text-align: center;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .menu {
            width: 250px;
            background-color: #333;
            color: white;
            padding-top: 1rem;
        }

        .menu ul {
            list-style-type: none;
            padding: 0;
        }

        .menu ul li {
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid #555;
        }

        .menu ul li a {
            text-decoration: none;
            color: white;
            display: block;
        }

        .menu ul li a:hover {
            background-color: #575757;
        }

        .content {
            flex: 1;
            padding: 2rem;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .content h2 {
            margin-bottom: 1.5rem;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .profile-grid label {
            font-weight: bold;
        }

        .profile-grid p {
            margin: 0;
        }

        .profile-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .profile-form button {
            background: linear-gradient(to right, #000428, #004e92);
            color: white;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .profile-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Staff Dashboard</h1>
    </header>

    <div class="dashboard">
        <div class="menu">
            <ul>
            <li><a href="staff_profile.php">Profile</a></li>
            <li><a href="?page=booking">Booking</a></li>
            <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>

        <div class="content">
            <h2>Profile Information</h2>
            <div class="profile-grid">
            <label for="name">Name:</label>
            <p><?php echo htmlspecialchars($ladies['name']); ?></p>

                <label for="package_type">Package Type:</label>
                <p><?php echo htmlspecialchars($ladies['package_type']); ?></p>

                <label for="package_details">Package Details:</label>
                <p><?php echo htmlspecialchars($ladies['package_details']); ?></p>

                <label for="experience">Experience:</label>
                <p><?php echo htmlspecialchars($ladies['experience']); ?></p>

                <label for="age">Age:</label>
                <p><?php echo htmlspecialchars($ladies['age']); ?></p>

                <label for="specialty">Specialty:</label>
                <p><?php echo htmlspecialchars($ladies['specialty']); ?></p>

                <label for="bio">Bio:</label>
                <p><?php echo htmlspecialchars($ladies['bio']); ?></p>

                <label for="contact_info">Contact Info:</label>
                <p><?php echo htmlspecialchars($ladies['contact_info']); ?></p>

                <label for="price">Price:</label>
                <p>RM<?php echo htmlspecialchars($ladies['price']); ?></p>

                <label for="photo">Profile Photo:</label>
                <p><img src="image/<?php echo htmlspecialchars($ladies['photo_url']); ?>" alt="Profile Photo" width="100"></p>
            </div>

            <!-- Edit Profile Button -->
            <div class="profile-form">
                <a href="staff_edit.php?id=<?php echo $ladies['id']; ?>"><button>Edit Profile</button></a>
            </div>
        </div>
    </div>
</body>
</html>

