<?php
session_start();
if (!isset($_SESSION['certificates'])) {
    header("Location: index.php");
    exit();
}
$certificates = $_SESSION['certificates'];
unset($_SESSION['certificates']); // Clear session after use
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Certificate Preview</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
body { font-family: 'Poppins', sans-serif; background: #0d1325; color: #fff; padding: 40px; }
.certificate { background: rgba(255,255,255,0.05); padding: 30px; margin-bottom: 20px; border-radius: 12px; }
h2 { color: #d4af37; margin-bottom: 15px; }
a.pdf-link { color: #1f4fd8; text-decoration: none; font-weight: 500; }
a.pdf-link:hover { text-decoration: underline; }
</style>
</head>
<body>

<h1>Certificate Details</h1>

<?php foreach ($certificates as $cert): ?>
<div class="certificate">
    <h2><?php echo htmlspecialchars($cert['holder_name']); ?></h2>
    <p><strong>Certificate Number:</strong> <?php echo htmlspecialchars($cert['certificate_no']); ?></p>
    <p><strong>Course:</strong> <?php echo htmlspecialchars($cert['course']); ?></p>
    <p><strong>Issue Date:</strong> <?php echo htmlspecialchars($cert['issue_date']); ?></p>
    <p><strong>PDF:</strong> 
        <a class="pdf-link" href="/certificate_tracker/admin/certificates/<?php echo htmlspecialchars($cert['pdf_file']); ?>" target="_blank">
            View Certificate
        </a>
        <hr>
        <a class="pdf-link" href="/certificate_tracker/admin/certificates/<?php echo htmlspecialchars($cert['pdf_file']); ?>" download>
           Download Certificate
        </a>
    </p>
</div>
<?php endforeach; ?>

<a href="index.php" style="color:#d4af37;">← Back to Home</a>

</body>
</html>
