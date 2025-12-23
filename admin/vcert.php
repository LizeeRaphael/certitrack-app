<?php
session_start();
include 'db.php';
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}

// Handle delete request
if(isset($_GET['delete_id'])){
    $id = intval($_GET['delete_id']);
    $res = mysqli_query($conn, "SELECT pdf_file FROM certificates WHERE id=$id");
    if($row = mysqli_fetch_assoc($res)){
        @unlink('certificates/'.$row['pdf_file']);
    }
    mysqli_query($conn, "DELETE FROM certificates WHERE id=$id");
    header("Location: vcert.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Certificates | CertiTrack</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--black:#0b0b0d;--dark:#0f1433;--blue:#1f4fd8;--gold:#d4af37;--white:#fff}
*{box-sizing:border-box}
body{margin:0;font-family:Poppins,sans-serif;background:linear-gradient(135deg,#050509,#0d1325);color:#fff}
.sidebar{width:240px;height:100vh;position:fixed;background:#070711;padding:25px 20px}
.sidebar h2{color:var(--gold);text-align:center;margin-bottom:35px}
.sidebar a{display:block;padding:14px 16px;margin-bottom:12px;color:#cfd8ff;text-decoration:none;border-radius:10px;font-weight:500}
.sidebar a:hover{background:rgba(31,79,216,.25);color:#fff}
.main{margin-left:240px;padding:35px}
.topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:30px}
.profile{background:rgba(255,255,255,.08);padding:10px 18px;border-radius:30px;font-size:14px}
table{width:100%;border-collapse:collapse;margin-top:20px}
th,td{padding:12px;text-align:left;border-bottom:1px solid rgba(255,255,255,0.1)}
th{color:var(--gold)}
button.download, button.delete{padding:6px 12px;border:none;color:#fff;border-radius:6px;cursor:pointer}
button.download{background:var(--blue)}
button.download:hover{background:#1738b8}
button.delete{background:#ff4d4d}
button.delete:hover{background:#cc0000}
@media(max-width:900px){.sidebar{position:relative;width:100%;height:auto}.main{margin-left:0}}
</style>
</head>
<body>

<div class="sidebar">
  <h2>CertiTrack</h2>
  <a href="admin_dashboard.php">Dashboard</a>
  <a href="upload.php">Upload Certificate</a>
  <a href="view_certificates.php" style="background:rgba(31,79,216,.25);color:#fff">View Certificates</a>
  <a href="#">Settings</a>
  <a href="logout.php" style="color:#ffb3b3">Logout</a>
</div>

<div class="main">
  <div class="topbar">
    <h1>View Certificates</h1>
    <div class="profile">Admin: <?php echo $_SESSION['admin']; ?></div>
  </div>

  <div class="section">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Certificate Number</th>
          <th>Holder Name</th>
          <th>Course</th>
          <th>Issue Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM certificates ORDER BY created_at DESC");
        $i = 1;
        while($row = mysqli_fetch_assoc($result)){
            echo '<tr>';
            echo '<td>'.$i.'</td>';
            echo '<td>'.$row['certificate_no'].'</td>';
            echo '<td>'.$row['holder_name'].'</td>';
            echo '<td>'.$row['course'].'</td>';
            echo '<td>'.$row['issue_date'].'</td>';
            echo '<td>';
            echo '<a href="certificates/'.$row['pdf_file'].'" download><button class="download">Download</button></a> ';
            echo '<a href="?delete_id='.$row['id'].'" onclick="return confirm(\'Are you sure to delete this certificate?\')"><button class="delete">Delete</button></a>';
            echo '</td>';
            echo '</tr>';
            $i++;
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
