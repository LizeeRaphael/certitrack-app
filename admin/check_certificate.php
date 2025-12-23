<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['admin'])) {
    echo json_encode(['exists' => false]);
    exit;
}

$certificate_no = mysqli_real_escape_string($conn, $_POST['certificate_no'] ?? '');

$q = mysqli_query(
    $conn,
    "SELECT id FROM certificates WHERE certificate_no='$certificate_no' LIMIT 1"
);

echo json_encode([
    'exists' => mysqli_num_rows($q) > 0
]);
