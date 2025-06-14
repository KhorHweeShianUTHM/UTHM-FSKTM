<div class="container">
<table class="table table-striped">
    <thead>
        <tr>
            <th>Customer Name</th>
            <th>Phone number</th>
            <th>Address</th>
            <th>Email</th>
        </tr>
    </thead>
    <?php
        include_once "../config/dbconnect.php";
        
        //echo $ID;
		$query = "SELECT * FROM users where isAdmin = 0";
		$result = mysqli_query($conn, $query) or die (mysqli_error());
		$row = mysqli_fetch_assoc($result);
    ?>
                <tr>
                    <td><?php echo $row["first_name"] . " " . $row["last_name"]; ?></td>
                    <td><?php echo $row["phonenum"]; ?></td>
					<td><?php echo $row["address"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>

</table>
</div>
