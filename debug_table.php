<?php
// debug_table.php
header('Content-Type: text/plain');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_pds";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check table structure
$result = $conn->query("DESCRIBE pds_personalinfo");
if ($result) {
    $columns = [];
    echo "Table structure:\n";
    while ($row = $result->fetch_assoc()) {
        echo $row['Field'] . " | " . $row['Type'] . "\n";
        $columns[] = $row['Field'];
    }
    echo "\nTotal columns: " . count($columns);
    echo "\nColumn names: " . implode(', ', $columns);
} else {
    echo "Error describing table: " . $conn->error;
}

$conn->close();
?>