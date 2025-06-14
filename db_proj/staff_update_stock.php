<?php
// update_stock.php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)$_POST['inventory_id'];
  $action = $_POST['action'];// +1 or -1

 $sql = "UPDATE inventory SET stock = GREATEST(stock " . 
       ($action === 'increase' ? '+ 1' : '- 1') . ", 0) WHERE inventory_id = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
   $stmt->close();

  
  // ✅ Update inventory status based on new stock value
  $updateStatusSQL = "
    UPDATE inventory 
    SET status = 
      CASE 
        WHEN stock = 0 THEN 'Out of Stock'
        WHEN stock BETWEEN 1 AND 5 THEN 'Low'
        ELSE 'In Stock'
      END
    WHERE inventory_id = ?";
  $statusStmt = $conn->prepare($updateStatusSQL);
  $statusStmt->bind_param("i", $id);
  $statusStmt->execute();
  $statusStmt->close();
}

$conn->close();

// Optional: redirect with notification
 header("Location: staff_inventory.php?updated=1");
exit;
?>
