<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape and assign data dari borang POST
    $inventory_id = mysqli_real_escape_string($conn, $_POST['inventory_id']);
    $inventory_name = mysqli_real_escape_string($conn, $_POST['inventory_name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $sku = mysqli_real_escape_string($conn, $_POST['sku']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // SQL Query untuk update
    $sql = "UPDATE inventory 
            SET inventory_name='$inventory_name', category='$category', sku='$sku', 
                price='$price', stock='$stock', status='$status'
            WHERE inventory_id='$inventory_id'";

    if (mysqli_query($conn, $sql)) {
        // Redirect balik ke inventory page jika berjaya
        header("Location: admin_inventory.php");
        exit();
    } else {
        echo "Ralat semasa kemas kini: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("Location: admin_inventory.php");
    exit();
}
?>