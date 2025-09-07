<?php
// save_personalinfo.php
session_start(); // Add session_start at the beginning
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

// Get POST data for personal information
$surname = $_POST['surname'] ?? '';
$firstname = $_POST['firstname'] ?? '';
$middlename = $_POST['middlename'] ?? '';
$nameext = $_POST['nameext'] ?? '';
$dob = $_POST['dob'] ?? '';
$pob = $_POST['pob'] ?? '';
$sex = $_POST['sex'] ?? '';
$civilstatus = $_POST['civil_status'] ?? '';
$height = $_POST['height'] ?? '';
$weight = $_POST['weight'] ?? '';
$bloodtype = $_POST['bloodtype'] ?? '';
$gsis = $_POST['gsis'] ?? '';
$pagibig = $_POST['pagibig'] ?? '';
$philhealth = $_POST['philhealth'] ?? '';
$sss = $_POST['sss'] ?? '';
$tin = $_POST['tin'] ?? '';
$agencyempno = $_POST['agency_no'] ?? '';

// Get citizenship data
$citizenship = $_POST['citizenship'] ?? '';
$dualcitizenship = '';
if ($citizenship === 'Dual Citizenship' && isset($_POST['dual_type']) && is_array($_POST['dual_type'])) {
    $dualType = $_POST['dual_type'];
    $country = $_POST['country'] ?? '';
    $dualcitizenship = implode(', ', $dualType);
    if (!empty($country)) {
        $dualcitizenship .= ' - ' . $country;
    }
}

// Get residential address data
$res_house = $_POST['res_house'] ?? '';
$res_street = $_POST['res_street'] ?? '';
$res_subdi = $_POST['res_subdivision'] ?? '';
$res_barangay = $_POST['res_barangay'] ?? '';
$res_city = $_POST['res_city'] ?? '';
$res_province = $_POST['res_province'] ?? '';
$res_zipcode = $_POST['res_zip'] ?? '';

// Get permanent address data
$per_house = $_POST['perm_house'] ?? '';
$per_street = $_POST['perm_street'] ?? '';
$per_subdi = $_POST['perm_subdivision'] ?? '';
$per_barangay = $_POST['perm_barangay'] ?? '';
$per_city = $_POST['perm_city'] ?? '';
$per_province = $_POST['perm_province'] ?? '';
$per_zipcode = $_POST['perm_zip'] ?? '';
$per_telno = $_POST['perm_telno'] ?? '';
$per_mobileno = $_POST['perm_mobileno'] ?? '';
$per_email = $_POST['perm_email'] ?? '';

// Validate required fields
if (empty($surname) || empty($firstname) || empty($dob) || empty($pob) || empty($sex) || empty($civilstatus) || empty($citizenship)) {
    echo json_encode(['status' => 'error', 'message' => 'Surname, First Name, Date of Birth, Place of Birth, Sex, Civil Status, and Citizenship are required']);
    exit;
}

// Get the next CSID value
$next_csid = 1;
$result = $conn->query("SELECT MAX(CSID) as max_csid FROM pds_personalinfo");
if ($result && $row = $result->fetch_assoc()) {
    $next_csid = $row['max_csid'] + 1;
}

// Prepare and bind - CORRECTED for 37 columns (37 question marks)
$sql = "INSERT INTO pds_personalinfo (
    CSID, cs_surname, cs_firstname, cs_middlename, cs_nameext, 
    cs_dateofbirth, cs_placeofbirth, cs_sex, cs_civilstatus, 
    cs_height, cs_weight, cs_bloodtype, cs_gsis, cs_pagibig, 
    cs_philhealth, cs_sss, cs_tin, cs_agencyempno,
    cs_citizenship, cs_dualcitizenship,
    cs_res_house, cs_res_street, cs_res_subdi, cs_res_barangay, cs_res_city, cs_res_province, cs_res_zipcode,
    cs_per_house, cs_per_street, cs_per_subdi, cs_per_barangay, cs_per_city, cs_per_province, cs_per_zipcode,
    cs_per_telno, cs_per_mobileno, cs_per_email
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
    exit;
}

// Bind parameters - 37 parameters total (37 "s" characters)
$stmt->bind_param("issssssssssssssssssssssssssssssssssss", 
    $next_csid, 
    $surname, $firstname, $middlename, $nameext,
    $dob, $pob, $sex, $civilstatus,
    $height, $weight, $bloodtype, $gsis, $pagibig,
    $philhealth, $sss, $tin, $agencyempno,
    $citizenship, $dualcitizenship,
    $res_house, $res_street, $res_subdi, $res_barangay, $res_city, $res_province, $res_zipcode,
    $per_house, $per_street, $per_subdi, $per_barangay, $per_city, $per_province, $per_zipcode,
    $per_telno, $per_mobileno, $per_email
);

// Execute the statement
if ($stmt->execute()) {
    // Store in session for future use
    $_SESSION['csid'] = $next_csid;
    
    // Return success response with CSID
    echo json_encode([
        'status' => 'success', 
        'message' => 'Personal information saved successfully', 
        'csid' => $next_csid
    ]);
} else {
    echo json_encode([
        'status' => 'error', 
        'message' => 'Error saving personal information: ' . $conn->error
    ]);
}

// Close connections
$stmt->close();
$conn->close();
?>