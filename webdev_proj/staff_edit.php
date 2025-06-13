<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kangaroocare";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the lady is logged in
if (!isset($_SESSION['ladies_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}


$ladies_id = $_SESSION['ladies_id'];
// Fetch user's profile information
$sql = "SELECT * FROM ladies WHERE id = $ladies_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the user data
    $ladies = $result->fetch_assoc();
} else {
    echo "Profile not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Handle profile update
    $name = $_POST['name'];
    $package_type = $_POST['package_type'];
    $package_details = $_POST['package_details'];
    $experience = $_POST['experience'];
    $age = $_POST['age'];
    $specialty = $_POST['specialty'];
    $bio = $_POST['bio'];
    $contact_info = $_POST['contact_info'];
    $price = $_POST['price'];
    $photo_url = $ladies['photo_url']; // Default to current photo

    if (isset($_FILES['photo_url']) && $_FILES['photo_url']['error'] == 0) {
        // Upload new photo if file is selected
        $target_dir = "image/";
        $target_file = $target_dir . basename($_FILES["photo_url"]["name"]);
        if (move_uploaded_file($_FILES["photo_url"]["tmp_name"], $target_file)) {
            $photo_url = basename($_FILES["photo_url"]["name"]);
        }
    }

    $update_sql = "UPDATE ladies SET name = '$name',  package_type = '$package_type', 
    package_details = '$package_details', 
    experience = '$experience', 
    age = '$age', 
    photo_url = '$photo_url', 
    specialty = '$specialty', 
    bio = '$bio', 
    contact_info = '$contact_info' 
    price = '$price' 
    WHERE id = $ladies_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Profile updated successfully!');</script>";
        // Refresh data
        $result_ladies = $conn->query($sql);
        $ladies = $result_ladies->fetch_assoc();
    } else {
        echo "<script>alert('Error updating profile: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        .content h2 {
            margin-bottom: 1.5rem;
            font-family: Georgia, 'Times New Roman', Times, serif;
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

        .profile-form input,
        .profile-form select,
        .profile-form textarea {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        .profile-form button {
            background: linear-gradient(to right, #000428, #004e92);
            color: white;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        .profile-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Edit Profile</h1>
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
            <h2>Edit Profile Information</h2>
            <form action="" method="POST" enctype="multipart/form-data" class="profile-form">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($ladies['name']); ?>" required>

               

                <label for="package_type">Package Type:</label>
                <select id="package_type" name="package_type" required>
                    <option value="Basic" <?php if ($ladies['package_type'] == 'Basic') echo 'selected'; ?>>Basic</option>
                    <option value="Premium" <?php if ($ladies['package_type'] == 'Premium') echo 'selected'; ?>>Premium</option>
                </select><br><br>

                <label for="package_details">Package Details:</label>
                <textarea id="package_details" name="package_details" rows="4" required><?php echo htmlspecialchars($ladies['package_details']); ?></textarea>

                <label for="experience">Experience (in years):</label>
                <input type="text" id="experience" name="experience" value="<?php echo htmlspecialchars($ladies['experience']); ?>" required>

                <label for="age">Age:</label>
                <input type="text" id="age" name="age" value="<?php echo htmlspecialchars($ladies['age']); ?>" required>

                <label for="photo_url">Upload Photo:</label>
                <input type="file" id="photo_url" name="photo_url" accept="image/*">
                <!-- Display existing photo if present -->
                <img src="image/<?php echo htmlspecialchars($ladies['photo_url']); ?>" alt="Current Photo" width="100"><br><br>

                <label for="specialty">Specialty:</label>
                <textarea id="specialty" name="specialty" rows="4" required><?php echo htmlspecialchars($ladies['specialty']); ?></textarea>

                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio" rows="4" required><?php echo htmlspecialchars($ladies['bio']); ?></textarea>

                <label for="contact_info">Contact Info:</label>
                <textarea id="contact_info" name="contact_info" rows="4" required><?php echo htmlspecialchars($ladies['contact_info']); ?></textarea>

                <label for="price">Price:</label>
                <textarea id="price" name="price" rows="4" required><?php echo htmlspecialchars($ladies['price']); ?></textarea>

                <button type="submit" name="update">Save Changes</button>
                <a href="staff_profile.php"><button type="button" class="cancel-button">Cancel</button></a>
                </form>
            </form>
        </div>
    </div>
</body>
</html>
