<?php
header('Content-Type: application/json');
require_once 'config.php';

// Function to calculate total inventory value
function getTotalInventoryValue($conn) {
    $sql = "SELECT SUM(price * stock) as total_value FROM inventory";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total_value'] ?? 0;
}

// Function to get percentage change
function getPercentageChange($conn) {
    $currentValue = getTotalInventoryValue($conn);
    
    // Store new value in history
    $today = date('Y-m-d');
    $sql = "INSERT INTO inventory_history (inventory_date, total_value) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sd", $today, $currentValue);
    $stmt->execute();

    // Get the two most recent records
    $sql = "SELECT total_value FROM inventory_history ORDER BY inventory_date DESC, id DESC LIMIT 2";
    $result = $conn->query($sql);
    $values = [];
    while ($row = $result->fetch_assoc()) {
        $values[] = $row['total_value'];
    }
    if (count($values) == 2) {
        $previousValue = $values[1];
        // Ensure current value is used as the more recent value for comparison
        $currentValueForComparison = $values[0]; 
        $percentageChange = $previousValue > 0 ? (($currentValueForComparison - $previousValue) / $previousValue) * 100 : 0;
    } else {
        $percentageChange = 0;
    }

    return [
        'total_value' => $currentValue, // This should be the live current value
        'percentage_change' => round($percentageChange, 2)
    ];
}

// Get inventory data
$data = getPercentageChange($conn);

// Return JSON response
echo json_encode($data);

$conn->close();
?>