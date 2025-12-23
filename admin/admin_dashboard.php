<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}

// Get total certificates
$certResult = mysqli_query($conn, "SELECT COUNT(*) AS total_certificates FROM certificates");
$certRow = mysqli_fetch_assoc($certResult);
$totalCertificates = $certRow['total_certificates'];

// Get total admins
$adminResult = mysqli_query($conn, "SELECT COUNT(*) AS total_admins FROM admin_users");
$adminRow = mysqli_fetch_assoc($adminResult);
$totalAdmins = $adminRow['total_admins'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard | CertiTrack</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --black:#0b0b0d;
  --dark:#0f1433;
  --blue:#1f4fd8;
  --gold:#d4af37;
  --white:#ffffff;
}
*{box-sizing:border-box}
body{
  margin:0;
  font-family:Poppins,sans-serif;
  background:linear-gradient(135deg,#050509,#0d1325);
  color:var(--white);
}
.sidebar{
  width:240px;
  height:100vh;
  position:fixed;
  background:#070711;
  padding:25px 20px;
}
.sidebar h2{
  color:var(--gold);
  text-align:center;
  margin-bottom:35px;
}
.sidebar a{
  display:block;
  padding:14px 16px;
  margin-bottom:12px;
  color:#cfd8ff;
  text-decoration:none;
  border-radius:10px;
  font-weight:500;
}
.sidebar a:hover{
  background:rgba(31,79,216,0.25);
  color:#fff;
}
.main{
  margin-left:240px;
  padding:35px;
}
.topbar{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:30px;
}
.topbar h1{
  font-size:26px;
}
.profile{
  background:rgba(255,255,255,0.08);
  padding:10px 18px;
  border-radius:30px;
  font-size:14px;
}
.cards{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
  gap:25px;
  margin-bottom:35px;
}
.card{
  background:linear-gradient(180deg,rgba(255,255,255,0.12),rgba(255,255,255,0.04));
  padding:25px;
  border-radius:18px;
  border:1px solid rgba(255,255,255,0.15);
}
.card h3{
  color:var(--gold);
  margin-bottom:8px;
  font-size:16px;
}
.card span{
  font-size:30px;
  font-weight:600;
}
.section{
  background:rgba(255,255,255,0.07);
  padding:25px;
  border-radius:18px;
  border:1px solid rgba(255,255,255,0.12);
}
.section h2{
  margin-bottom:15px;
  color:var(--gold);
}
@media(max-width:900px){
  .sidebar{position:relative;width:100%;height:auto}
  .main{margin-left:0}
}
</style>
</head>
<body>

<div class="sidebar">
  <h2>CertiTrack</h2>
  <a href="#">Dashboard</a>
  <a href="upload.php">Upload Certificate</a>
  <a href="vcert.php">View Certificates</a>
  <a href="setting.php">Settings</a>
  <a href="logout.php" style="color:#ffb3b3">Logout</a>
</div>

<div class="main">
  <div class="topbar">
    <h1>Admin Dashboard</h1>
    <div class="profile">Admin: <?php echo $_SESSION['admin']; ?></div>
  </div>

<div class="cards">
  <div class="card">
    <h3>Total Certificates</h3>
    <span><?php echo $totalCertificates; ?></span>
  </div>
  <div class="card">
    <h3>Admins</h3>
    <span><?php echo $totalAdmins; ?></span>
  </div>
</div>


  <div class="section">
    <h2>Dashboard Overview</h2>
    <p>
      Use this admin panel to upload certificates (PDF), manage certificate records,
      monitor verification activity, and configure system settings.
    </p>
  </div>
</div>

</body>
</html>