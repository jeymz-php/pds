<?php
// save_children.php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_pds";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Check if CSID is provided in POST request
if (!isset($_POST['csid']) || empty($_POST['csid'])) {
    echo json_encode(['status' => 'error', 'message' => 'CSID is required. Please save personal information first.']);
    exit;
}

$csid = $_POST['csid'];

try {
    // Delete existing children records for this CSID
    $deleteQuery = "DELETE FROM pds_cschildren WHERE CSID = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param("i", $csid);
    $deleteStmt->execute();
    
    // Insert new children records
    if (isset($_POST['children']) && !empty($_POST['children'])) {
        $children = json_decode($_POST['children'], true);
        
        $insertQuery = "INSERT INTO pds_cschildren (CSID, children_name, children_dateofbirth) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        
        foreach ($children as $child) {
            if (!empty($child['name']) && !empty($child['dob'])) {
                $insertStmt->bind_param("iss", $csid, $child['name'], $child['dob']);
                $insertStmt->execute();
            }
        }
        
        $insertStmt->close();
    }
    
    echo json_encode(['status' => 'success', 'message' => 'Children information saved successfully']);
    
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}

$conn->close();
?>