<?php
// db.php
$host = 'localhost';
$user = 'root';
$pass = '';        // set if you have a MySQL password
$db   = 'db_pds';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    http_response_code(500);
    die('Database connection failed: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');
