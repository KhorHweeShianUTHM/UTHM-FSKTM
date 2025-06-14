<?php


header('Content-Type: application/json');

// --- Database Configuration ---
// !!! IMPORTANT: Replace with your actual database credentials !!!
$dbHost = '127.0.0.1';        // Or your database host
$dbName = 'ahk_workshop';   // Your database name from job_cards.sql
$dbUser = 'root';           // Your database username
$dbPass = '';               // Your database password (ensure this is correct for your setup)
         // Default MySQL/MariaDB port

// --- Get Year from Request ---
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

// --- Initialize Months Array and Default Response ---
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$monthlyRevenues = array_fill(0, 12, 0);
$response = ['labels' => $months, 'values' => $monthlyRevenues, 'error' => null]; // Prepare a default response

try {
    // Check if PDO MySQL driver is available
    if (!in_array('mysql', PDO::getAvailableDrivers())) {
        throw new Exception("PDO MySQL driver not available. Please check your PHP configuration (php.ini) and ensure the extension (e.g., php_pdo_mysql) is enabled.");
    }

    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Good practice

    $sql = "SELECT
                MONTH(date_out) AS month,
                SUM(amount) AS total_revenue
            FROM
                job_cards
            WHERE
                YEAR(date_out) = :year AND status = 'Completed'
            GROUP BY
                MONTH(date_out)
            ORDER BY
                month ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row) {
        $monthIndex = intval($row['month']) - 1;
        if ($monthIndex >= 0 && $monthIndex < 12) {
            $monthlyRevenues[$monthIndex] = floatval($row['total_revenue']);
        }
    }
    $response['values'] = $monthlyRevenues; // Update values in the response

} catch (PDOException $e) {
    $response['error'] = 'Database Connection/Query Error: ' . $e->getMessage();
    // For detailed debugging, you might want to log $e->getTraceAsString() to a server file.
} catch (Exception $e) {
    $response['error'] = 'PHP Script Error: ' . $e->getMessage();
}
echo json_encode($response);

?>