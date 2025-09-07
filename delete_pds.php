<?php
// delete_pds.php
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

// Check if CSID is provided
if (!isset($_POST['csid']) || empty($_POST['csid'])) {
    echo json_encode(['status' => 'error', 'message' => 'CSID is required']);
    exit;
}

$csid = $_POST['csid'];

try {
    // Start transaction
    $conn->begin_transaction();

    // Delete from all tables
    $conn->query("DELETE FROM pds_cschildren WHERE CSID = $csid");
    $conn->query("DELETE FROM pds_educ WHERE CSID = $csid");
    $conn->query("DELETE FROM pds_familybackground WHERE CSID = $csid");
    $conn->query("DELETE FROM pds_personalinfo WHERE CSID = $csid");

    // Commit transaction
    $conn->commit();

    echo json_encode(['status' => 'success', 'message' => 'PDS deleted successfully']);

} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}

// Close connection
$conn->close();
?>