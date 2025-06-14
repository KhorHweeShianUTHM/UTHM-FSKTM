<div >
  <h2>All Customers</h2>
  <table class="table" style="width:100%;">
    <thead>
      <tr>
        <th style="text-align:center;">S.N.</th>
        <th style="text-align:center;">Fullname</th>
		<th style="text-align:center;">Email</th>
		<th style="text-align:center;">Phone Number</th>
		<th style="text-align:center;">address</th>
        <th style="text-align:center;">Joining Date</th>
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from users where isAdmin = 0";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
           
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$row["first_name"]?> <?=$row["last_name"]?></td>
	  <td><?=$row["email"]?></td>
	  <td><?=$row["phonenum"]?></td>
	  <td><?=$row["address"]?></td>
      <td><?=$row["registered_at"]?></td>
    </tr>
    <?php
            $count=$count+1;
           
        }
    }
    ?>
  </table>