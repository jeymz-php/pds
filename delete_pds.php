<?php

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_pds";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

if (!isset($_POST['csid']) || empty($_POST['csid'])) {
    echo json_encode(['status' => 'error', 'message' => 'CSID is required']);
    exit;
}

$csid = $_POST['csid'];

try {
    $conn->begin_transaction();

    $conn->query("DELETE FROM pds_cschildren WHERE CSID = $csid");
    $conn->query("DELETE FROM pds_educ WHERE CSID = $csid");
    $conn->query("DELETE FROM pds_familybackground WHERE CSID = $csid");
    $conn->query("DELETE FROM pds_personalinfo WHERE CSID = $csid");

    $conn->commit();

    echo json_encode(['status' => 'success', 'message' => 'PDS deleted successfully']);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}

$conn->close();
?>