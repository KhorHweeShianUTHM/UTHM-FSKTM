<?php
// --- Database Connection Details
// IMPORTANT: Replace with your actual database credentials
$servername = "127.0.0.1"; // Or "localhost"
$username = "root";       // Your database username
$password = "";           // Your database password
$dbname = "ahk_workshop";   // Your database name

// --- Set Header
// Set header to return JSON content, which is the standard for APIs
header('Content-Type: application/json');

// --- Helper function to validate date format
// This ensures we only work with dates in the 'YYYY-MM-DD' format.
function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

// --- Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// --- Check Connection
if ($conn->connect_error) {
    // Exit immediately and return a JSON error if the connection fails
    echo json_encode(['error' => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// --- Prepare Data
$params = [];
$types = "";

// Base SQL query remains the same
$sql = "SELECT service, SUM(amount) as total_amount FROM job_cards WHERE status = 'Completed'";

// --- Filter by Date (if valid dates are provided)
// Check if 'from_date' is set and is a valid date format
// --- Filter by Date (if valid dates are provided)
if (isset($_GET['from_date']) && !empty($_GET['from_date']) && validateDate($_GET['from_date'])) {
    $sql .= " AND date_out >= ?";
    $params[] = $_GET['from_date'] . " 00:00:00"; // Start of the day
    $types .= "s";
}

if (isset($_GET['to_date']) && !empty($_GET['to_date']) && validateDate($_GET['to_date'])) {
    $sql .= " AND date_out <= ?";
    $params[] = $_GET['to_date'] . " 23:59:59"; // End of the day
    $types .= "s";
}

// Complete the SQL query
$sql .= " GROUP BY service ORDER BY total_amount DESC";

// --- Prepare and Execute Statement
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo json_encode(['error' => "SQL prepare failed: " . $conn->error]);
    $conn->close();
    exit();
}

// --- Bind Parameters (Simplified and Safer)
// Only bind parameters if there are any to bind
if (!empty($params)) {
    // This is a modern and cleaner way to bind multiple parameters
    $stmt->bind_param($types, ...$params);
}

// --- Execute and Fetch Results
$stmt->execute();
$result = $stmt->get_result();

$labels = [];
$values = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Use a placeholder if service name is null or empty
        $serviceName = (!empty($row['service'])) ? $row['service'] : 'Uncategorized';
        $labels[] = $serviceName;
        $values[] = (float)$row['total_amount']; // Ensure amount is a float
    }
}

// --- Close Connections
$stmt->close();
$conn->close();

// --- Return Data as JSON
// This will return {"labels":[], "values":[]} if no data is found, which is correct.
echo json_encode(['labels' => $labels, 'values' => $values]);
?>