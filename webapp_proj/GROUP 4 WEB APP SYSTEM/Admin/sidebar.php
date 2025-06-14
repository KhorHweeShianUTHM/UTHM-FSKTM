<?php
include ("config/dbconnect.php");
	
$query = "SELECT * FROM adminlogin";
$result = mysqli_query($conn, $query) or die (mysqli_error());
$row = mysqli_fetch_assoc($result);

?>

<div class="sidebar" id="mySidebar">
	<div class="side-header">
		<img src="./assets/images/logo.png" width="100" height="100" alt="Swiss Collection"> 
		<h5 style="margin-top:10px;">Hello,  <?php echo $row["first_name"] . " " . $row["last_name"]; ?> Admin.</h5>
	</div>

    <a href="javascript:void(0)" class="closebtn" style="font-size:50px;" onclick="closeNav()">×</a>
    <a href="./index.php" style="margin-top:50px;"><h6><i class="fa fa-home"></i> Dashboard</h6></a>
    <a href="#customers" onclick="showCustomers()"><h6><i class="fa fa-users"></i> Customers</h6></a>  
	<a href="#category"   onclick="showCategory()" ><h6><i class="fa fa-th-large"></i> Category</h6></a> 
    <a href="#products" onclick="showProductItems()"><h6><i class="fa fa-th"></i> Products</h6></a>
    <a href="#orders" onclick="showOrders()"><h6><i class="fa fa-list"></i> Orders</h6></a>
	<a href="logout.php"><h6><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</h6></a>
  
</div>
 
<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa-solid fa-bars"></i></button>
</div>


