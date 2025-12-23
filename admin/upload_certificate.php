<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['admin'])) {
    echo json_encode(['status'=>'error','message'=>'Unauthorized access']);
    exit;
}

$certificate_no = mysqli_real_escape_string($conn,$_POST['certificate_no'] ?? '');
$holder_name    = mysqli_real_escape_string($conn,$_POST['holder_name'] ?? '');
$course         = mysqli_real_escape_string($conn,$_POST['course'] ?? '');
$issue_date     = mysqli_real_escape_string($conn,$_POST['issue_date'] ?? '');
$force_upload   = isset($_POST['force_upload']);

// ✅ STEP 1: CHECK ONLY (NO FILE YET)
if(!$force_upload){
    $check = mysqli_query($conn,"SELECT id FROM certificates WHERE certificate_no='$certificate_no'");
    $count = mysqli_num_rows($check);

    if($count > 0){
        echo json_encode([
            'status' => 'exists',
            'count'  => $count
        ]);
        exit;
    }
}

// ✅ STEP 2: REAL UPLOAD
if (
    empty($certificate_no) ||
    empty($holder_name) ||
    empty($course) ||
    empty($issue_date)
) {
    echo json_encode(['status'=>'error','message'=>'All fields are required']);
    exit;
}

if (!isset($_FILES['certificate_pdf'])) {
    echo json_encode(['status'=>'error','message'=>'PDF is required']);
    exit;
}

$file = $_FILES['certificate_pdf'];
$ext  = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

if ($ext !== 'pdf') {
    echo json_encode(['status'=>'error','message'=>'Only PDF allowed']);
    exit;
}

if ($file['size'] > 5242880) {
    echo json_encode(['status'=>'error','message'=>'Max size is 5MB']);
    exit;
}

$dir = 'certificates/';
if (!is_dir($dir)) mkdir($dir,0777,true);

$filename = 'CERT_' . time() . '_' . rand(1000,9999) . '.pdf';
$path = $dir . $filename;

if (!move_uploaded_file($file['tmp_name'], $path)) {
    echo json_encode(['status'=>'error','message'=>'Upload failed']);
    exit;
}

$insert = mysqli_query($conn,"
INSERT INTO certificates
(certificate_no, holder_name, course, issue_date, pdf_file)
VALUES
('$certificate_no','$holder_name','$course','$issue_date','$filename')
");

if($insert){
    echo json_encode([
        'status'=>'success',
        'message'=>'Certificate uploaded successfully'
    ]);
} else {
    echo json_encode(['status'=>'error','message'=>'Database error']);
}
