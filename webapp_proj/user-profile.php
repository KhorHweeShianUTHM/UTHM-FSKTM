<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: user-login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch user information from the database
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "swiss_collection";

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $address = $row['address'];
    $phonenum = $row['phonenum'];
	$email = $row['email'];
	$registered_at = $row['registered_at'];
} else {
    echo "User not found!";
    exit();
}

// Close the database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Caffeine & Calories by Gastro Scholar</title>
	<link rel="shortcut icon" type="x-icon" href="images/logo_1.ico"/>
	<script src="https://kit.fontawesome.com/3b737278a4.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/navigationBar.css">
	<link rel="stylesheet" href="css/searchBar.css">
	<link rel="stylesheet" href="css/profileSection.css">
	<link rel="stylesheet" href="css/footerBar.css">
	<style>
		* {
			margin: 0px;
			padding: 0px;
			box-sizing: border-box;
			font-family: sans-serif;
			background-image();
		}
		
	</style>

</head>

<body>

    <nav>
        <ul>
			<li class="logo"><a href="index.html">Caffeine & Calories by Gastro Scholar</a></li>
			<li class="about"><a href="about.html">About</a></li>
			<li class="menu">
				<a>Menu</a>
				<ul class="dropdown">
					<li><a href="coffeemenu.html">Coffee</a></li>
					<li><a href="frappemenu.html">Frappe</a></li>
					<li><a href="noncoffeemenu.html">Non-Coffee</a></li>
				</ul>
			</li>
			<li class="tracking"><a href="trackingDelivery.html">Tracking</a></li>
			<form id="searchForm" style="float:right">
				<input type="text" id="searchInput" placeholder="Search Google">
				<button type="button" id="searchButton" onclick="googleSearch()">
					<i class="fas fa-search"></i>
				</button>
			</form>
			<li class="shoppingcart" style="float:right"><a href="viewcart.html"><i class="icon fa-solid fa-cart-shopping"></i></a></li>
			<li class="user" style="float:right"><a href="profile_link.php"><i class="fa-solid fa-user"></i></a></li>
		</ul>
    </nav>
	
	<div class="profile">
		<h2>User Profile</h2>
		<label for="name">Full Name: <?php echo $row["first_name"] . " " . $row["last_name"]; ?></label>
		<label for="email">Email: <?php echo $row["email"]; ?></label>
		<label for="phone">Phone Number: <?php echo $row["phonenum"]; ?></label>
		<label for="address">Address: <?php echo $row["address"]; ?></label>
		<label for="Joining Date">Joining Date: <?php echo $row["registered_at"]; ?></label>	
		
		<a href="user-logout.php"><button type="submit">Logout</button></a>
	</div>
	
	<footer>
		<div class="footericon">
			<a href="https://www.facebook.com/cncbygastroscholar"><i class="fa-brands fa-facebook"></i></a>
			<a href="https://www.instagram.com/gastroscholar/"><i class="fa-brands fa-instagram"></i></a>
			<a href="https://www.tiktok.com/@caffeineandcaloriesrmc"><i class="fa-brands fa-tiktok"></i></a>
		</div>
		<div class="footernav">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="about.html">About</a></li>
				<li><a href="trackingDelivery.html">Tracking</a></li>
				<li><a href="./Admin/page-login.html">Admin Login</a></li>
			</ul>
		</div>
		<div class="footerbottom">
			<p> Copyright &copy; 2023; Designed by <span class="designer">KHOR HWEE SHIAN</span></p>
		</div>
	</footer>
	
	<script type="text/javascript" src="js/googleSearch.js"></script>
	
</body>
</html>


