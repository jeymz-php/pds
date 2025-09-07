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

try {
    $personalInfo = [];
    $result = $conn->query("SELECT * FROM pds_personalinfo ORDER BY CSID DESC");
    while ($row = $result->fetch_assoc()) {
        $personalInfo[$row['CSID']] = $row;
    }

    $familyBackground = [];
    $result = $conn->query("SELECT * FROM pds_familybackground");
    while ($row = $result->fetch_assoc()) {
        $familyBackground[$row['CSID']] = $row;
    }

    $children = [];
    $result = $conn->query("SELECT * FROM pds_cschildren");
    while ($row = $result->fetch_assoc()) {
        if (!isset($children[$row['CSID']])) {
            $children[$row['CSID']] = [];
        }
        $children[$row['CSID']][] = $row;
    }

    $education = [];
    $result = $conn->query("SELECT * FROM pds_educ");
    while ($row = $result->fetch_assoc()) {
        $education[$row['CSID']] = $row;
    }

    $allData = [];
    foreach ($personalInfo as $csid => $personal) {
        $allData[] = [
            'csid' => $csid,
            'personal' => $personal,
            'family' => $familyBackground[$csid] ?? null,
            'children' => $children[$csid] ?? [],
            'education' => $education[$csid] ?? null
        ];
    }

    echo json_encode(['status' => 'success', 'data' => $allData]);

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}

$conn->close();
?>