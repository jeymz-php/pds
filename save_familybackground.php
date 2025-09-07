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

$csid = $_POST['csid'] ?? '';

if (empty($csid)) {
    echo json_encode(['status' => 'error', 'message' => 'CSID is required. Please save personal information first.']);
    exit;
}

$spouse_surname = $_POST['spouse_surname'] ?? '';
$spouse_firstname = $_POST['spouse_firstname'] ?? '';
$spouse_middlename = $_POST['spouse_middlename'] ?? '';
$spouse_nameext = $_POST['spouse_extension'] ?? '';
$spouse_occupation = $_POST['spouse_occupation'] ?? '';
$spouse_employer = $_POST['spouse_employer'] ?? '';
$spouse_businessadd = $_POST['spouse_business_address'] ?? '';
$spouse_telno = $_POST['spouse_tel'] ?? '';

$father_surname = $_POST['father_surname'] ?? '';
$father_firstname = $_POST['father_firstname'] ?? '';
$father_middlename = $_POST['father_middlename'] ?? '';
$father_nameext = $_POST['father_extension'] ?? '';

$mother_surname = $_POST['mother_surname'] ?? '';
$mother_firstname = $_POST['mother_firstname'] ?? '';
$mother_middlename = $_POST['mother_middlename'] ?? '';
$mother_nameext = $_POST['mother_extension'] ?? '';

if (empty($father_surname) || empty($father_firstname) || empty($mother_surname) || empty($mother_firstname)) {
    echo json_encode(['status' => 'error', 'message' => 'Father\'s and Mother\'s basic information (surname and first name) are required']);
    exit;
}

$sql = "INSERT INTO pds_familybackground (
    CSID, spouse_surname, spouse_firstname, spouse_middlename, spouse_nameext, 
    spouse_occupation, spouse_employer, spouse_businessadd, spouse_telno,
    father_surname, father_firstname, father_middlename, father_nameext,
    mother_surname, mother_firstname, mother_middlename, mother_nameext
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param("issssssssssssssss", 
    $csid,
    $spouse_surname, $spouse_firstname, $spouse_middlename, $spouse_nameext,
    $spouse_occupation, $spouse_employer, $spouse_businessadd, $spouse_telno,
    $father_surname, $father_firstname, $father_middlename, $father_nameext,
    $mother_surname, $mother_firstname, $mother_middlename, $mother_nameext
);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Family background saved successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error saving data: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>