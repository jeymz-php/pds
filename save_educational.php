<?php
// save_educational.php
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
    echo json_encode(['status' => 'error', 'message' => 'CSID is required. Please save personal information first.']);
    exit;
}

$csid = $_POST['csid'];

// Get all educational data with proper null coalescing
$elem_name = $_POST['elem_name'] ?? '';
$elem_course = $_POST['elem_course'] ?? '';
$elem_start = $_POST['elem_start'] ?? '';
$elem_end = $_POST['elem_end'] ?? '';
$elem_highestlevel = $_POST['elem_highestlevel'] ?? '';
$elem_yrgrad = $_POST['elem_yrgrad'] ?? '';
$elem_honor = $_POST['elem_honor'] ?? '';

$secondary_name = $_POST['secondary_name'] ?? '';
$secondary_course = $_POST['secondary_course'] ?? '';
$secondary_start = $_POST['secondary_start'] ?? '';
$secondary_end = $_POST['secondary_end'] ?? '';
$secondary_highestlevel = $_POST['secondary_highestlevel'] ?? '';
$secondary_yrgrad = $_POST['secondary_yrgrad'] ?? '';
$secondary_honor = $_POST['secondary_honor'] ?? '';

$vocational_name = $_POST['vocational_name'] ?? '';
$vocational_course = $_POST['vocational_course'] ?? '';
$vocational_start = $_POST['vocational_start'] ?? '';
$vocational_end = $_POST['vocational_end'] ?? '';
$vocational_highestlevel = $_POST['vocational_highestlevel'] ?? '';
$vocational_yrgrad = $_POST['vocational_yrgrad'] ?? '';
$vocational_honor = $_POST['vocational_honor'] ?? '';

$college_name = $_POST['college_name'] ?? '';
$college_course = $_POST['college_course'] ?? '';
$college_start = $_POST['college_start'] ?? '';
$college_end = $_POST['college_end'] ?? '';
$college_highestlevel = $_POST['college_highestlevel'] ?? '';
$college_yrgrad = $_POST['college_yrgrad'] ?? '';
$college_honor = $_POST['college_honor'] ?? '';

$grad_name = $_POST['grad_name'] ?? '';
$grad_course = $_POST['grad_course'] ?? '';
$grad_start = $_POST['grad_start'] ?? '';
$grad_end = $_POST['grad_end'] ?? '';
$grad_highestlevel = $_POST['grad_highestlevel'] ?? '';
$grad_yrgrad = $_POST['grad_yrgrad'] ?? '';
$grad_honor = $_POST['grad_honor'] ?? '';

// For signature, we'll handle file upload separately - for now just store empty string
$cs_sig = '';
$cs_date = $_POST['cs_date'] ?? '';

try {
    // Prepare and bind - CORRECTED for 38 columns (CSID + 36 educational fields + cs_sig + cs_date)
    $sql = "INSERT INTO pds_educ (
        CSID, 
        elem_name, elem_course, elem_start, elem_end, elem_highestlevel, elem_yrgrad, elem_honor,
        secondary_name, secondary_course, secondary_start, secondary_end, secondary_highestlevel, secondary_yrgrad, secondary_honor,
        vocational_name, vocational_course, vocational_start, vocational_end, vocational_highestlevel, vocational_yrgrad, vocational_honor,
        college_name, college_course, college_start, college_end, college_highestlevel, college_yrgrad, college_honor,
        grad_name, grad_course, grad_start, grad_end, grad_highestlevel, grad_yrgrad, grad_honor,
        cs_sig, cs_date
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    // Bind parameters - 38 parameters total (CSID + 36 educational fields + cs_sig + cs_date)
    $stmt->bind_param("isssssssssssssssssssssssssssssssssssss", 
        $csid,
        $elem_name, $elem_course, $elem_start, $elem_end, $elem_highestlevel, $elem_yrgrad, $elem_honor,
        $secondary_name, $secondary_course, $secondary_start, $secondary_end, $secondary_highestlevel, $secondary_yrgrad, $secondary_honor,
        $vocational_name, $vocational_course, $vocational_start, $vocational_end, $vocational_highestlevel, $vocational_yrgrad, $vocational_honor,
        $college_name, $college_course, $college_start, $college_end, $college_highestlevel, $college_yrgrad, $college_honor,
        $grad_name, $grad_course, $grad_start, $grad_end, $grad_highestlevel, $grad_yrgrad, $grad_honor,
        $cs_sig, $cs_date
    );

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Educational background saved successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error saving educational background: ' . $stmt->error]);
    }
    
    // Close statement
    $stmt->close();
    
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}

// Close connection
$conn->close();
?>