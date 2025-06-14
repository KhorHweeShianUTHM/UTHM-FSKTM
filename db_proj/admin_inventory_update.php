<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $inventory_id = mysqli_real_escape_string($conn, $_POST['inventory_id']);
    $inventory_name = mysqli_real_escape_string($conn, $_POST['inventory_name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $sku = mysqli_real_escape_string($conn, $_POST['sku']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "UPDATE inventory 
            SET inventory_name ='$inventory_name', category = '$category', sku = '$sku', price = '$price', stock = '$stock', status = '$status' 
            WHERE inventory_id = '$inventory_id'";

    if (mysqli_query($conn, $sql)) {
        // Redirect back to inventory page after update
        header("Location: inventory.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    // Redirect back if accessed directly without POST
    header("Location: inventory.php");
    exit();
}
?>
