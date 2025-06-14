<?php
$conn = new mysqli('localhost','root','','swiss_collection');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$beverageName = $_POST['beverageName'];
$beverageTemp = $_POST['beverageTemp'];
$sugarLevel = $_POST['sugarLevel'];
$addons = isset($_POST['addons']) ? implode(',', $_POST['addons']) : '';
$totalPrice = $_POST['totalPrice'];

$sql = "INSERT INTO orders (beverage_name, beverage_temp, sugar_level, addons, total_price) VALUES ('$beverageName', '$beverageTemp', '$sugarLevel', '$addons', '$totalPrice')";

if ($conn->query($sql) === TRUE) {
	echo '<script>alert("Order placed successfully.");</script>';
	echo '<script>
        setTimeout(function(){
            window.location.href = "frappemenu.html";
        }, 200); 
      </script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>