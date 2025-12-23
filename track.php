<?php
session_start();
include 'db.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = trim($_POST['query']);

    if (!empty($query)) {
        $search = "%$query%";
        $stmt = $conn->prepare("SELECT * FROM certificates WHERE certificate_no LIKE ? OR holder_name LIKE ?");
        $stmt->bind_param("ss", $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $certificates = $result->fetch_all(MYSQLI_ASSOC);
            $_SESSION['certificates'] = $certificates;
            header("Location: preview.php");
            exit();
        } else {
            $_SESSION['error'] = "No certificate found with that number or name.";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Please enter a certificate number or holder name.";
        header("Location: index.php");
        exit();
    }
}
?>
