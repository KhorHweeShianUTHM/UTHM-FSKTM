<?php
// Database connection settings
$servername = "localhost"; // change this if your DB server is different
$username = "root";        // change this if your DB user is different
$password = "";            // change this if your DB password is different
$dbname = "kangaroocare";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $full_name = $_POST['full-name'];
    $edd = $_POST['edd'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $hospital = $_POST['hospital'];
    $delivery_type = $_POST['delivery-type'];
    $duration = $_POST['duration'];
    $package = $_POST['package'];

    // Prepare SQL query with the approval_status column set to 'pending'
    $sql = "INSERT INTO bookings (full_name, edd, age, phone, location, hospital, delivery_type, duration, package, approval_status)
            VALUES ('$full_name', '$edd', '$age', '$phone', '$location', '$hospital', '$delivery_type', '$duration', '$package', 'pending')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking submitted successfully! Your approval status is currently 'Pending'.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>

<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <style>
        /* Styles for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #89CFF0, #1E1E6D);
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            text-align: center;
            background-color: #1E1E6D;
            color: #fff;
            padding: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 14px;
        }

        .steps {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background: #f9f9f9;
        }

        .step {
            text-align: center;
            flex: 1;
        }

        .step img {
            max-width: 60px;
            margin-bottom: 10px;
        }

        .step p {
            margin: 0;
            font-size: 14px;
        }

        .step p.title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .booking-form {
            padding: 20px;
        }

        .booking-form h2 {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #1E1E6D;
            outline: none;
        }

        .form-group button {
            background: #1E1E6D;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>How To Book The Confinement Lady?</h1>
        <p>Easy. Just follow below steps.</p>
    </div>

    <div class="steps">
        <div class="step">
            <img src="kangaroocare/check.png" alt="Check Icon">
            <p class="title">CHECK</p>
            <p>The price first.</p>
        </div>
        <div class="step">
            <img src="kangaroocare/choose.png" alt="Choose Icon">
            <p class="title">CHOOSE</p>
            <p>Your desired package.</p>
        </div>
        <div class="step">
            <img src="kangaroocare/enter.png" alt="Enter Icon">
            <p class="title">ENTER</p>
            <p>Your personal details.</p>
        </div>
        <div class="step">
            <img src="kangaroocare/add.png" alt="Add Icon">
            <p class="title">ADD</p>
            <p>Any add-on services.</p>
        </div>
        <div class="step">
            <img src="kangaroocare/done.png" alt="Done Icon">
            <p class="title">DONE</p>
            <p>Let go all the worries!</p>
        </div>
    </div>

    <div class="booking-form">
        <h2>Booking Form</h2>
        <p>I'm interested, but want to know more about your offerings</p>

        <form action="" method="post">
            <!-- Booking form inputs -->
            <div class="form-group">
                <label for="full-name">Full Name <span style="color: red;">*</span></label>
                <input type="text" id="full-name" name="full-name" placeholder="Enter your name" required>
            </div>

   <div class="form-group">
                <label for="edd">EDD <span style="color: red;">*</span> (Expected Date of Delivery)</label>
                <input type="date" id="edd" name="edd" required>
            </div>

            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" placeholder="How old are you?">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number <span style="color: red;">*</span></label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>

            <div class="form-group">
                <label for="location">Location (State in Malaysia) <span style="color: red;">*</span></label>
                <select id="location" name="location" required>
                    <option value="" disabled selected>Select your state</option>
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Melaka">Melaka</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Penang">Penang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Putrajaya">Putrajaya</option>
                    <option value="Labuan">Labuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="hospital">Hospital Type <span style="color: red;">*</span></label>
                <select id="hospital" name="hospital" required>
                    <option value="" disabled selected>Select hospital type</option>
                    <option value="government">Government</option>
                    <option value="private">Private</option>
                </select>
            </div>

            <div class="form-group">
                <label for="delivery-type">Delivery Type <span style="color: red;">*</span></label>
                <select id="delivery-type" name="delivery-type" required>
                    <option value="" disabled selected>Select delivery type</option>
                    <option value="normal">Normal</option>
                    <option value="c-section">C-section</option>
                </select>
            </div>

            <div class="form-group">
                <label for="duration">Duration <span style="color: red;">*</span></label>
                <select id="duration" name="duration" required>
                    <option value="" disabled selected>Select duration</option>
                    <option value="7">7 Days</option>
                    <option value="14">14 Days</option>
                    <option value="21">21 Days</option>
                    <option value="28">28 Days</option>
                </select>
            </div>

            <div class="form-group">
                <label for="package">Select a Package <span style="color: red;">*</span></label>
                <select id="package" name="package" required>
                    <option value="" disabled selected>Select your package</option>
                    <option value="basic">Basic Package</option>
                    <option value="premium">Premium Package</option>
                </select>
            </div>


            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>
    
