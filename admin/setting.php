<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}

$msg = "";

if(isset($_POST['change_password'])){
    $currentPassword = $_POST['current_password'];
    $newPassword     = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $adminEmail      = $_SESSION['admin'];

    $res = mysqli_query($conn, "SELECT password FROM admin_users WHERE email='$adminEmail'");
    $row = mysqli_fetch_assoc($res);

    if($row['password'] !== $currentPassword){
        $msg = "<span style='color:#ff4d4d'>Current password is incorrect.</span>";
    } elseif($newPassword !== $confirmPassword){
        $msg = "<span style='color:#ff4d4d'>New password and confirm password do not match.</span>";
    } else {
        mysqli_query($conn, "UPDATE admin_users SET password='$newPassword' WHERE email='$adminEmail'");
        $msg = "<span style='color:#9affb1'>Password changed successfully.</span>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Settings | CertiTrack</title>
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
.form-box{max-width:500px;background:rgba(255,255,255,.08);padding:35px;border-radius:20px;border:1px solid rgba(255,255,255,.15)}
.form-box h2{color:var(--gold);margin-bottom:20px}
.input-group{position:relative;margin-bottom:15px}
input,button{width:100%;padding:14px;border-radius:10px;border:none;font-size:14px}
input{background:#0e1535;color:#fff}
button{background:linear-gradient(135deg,var(--gold),#f5d76e);font-weight:600;cursor:pointer}
.toggle-pass{position:absolute;right:12px;top:50%;transform:translateY(-50%);cursor:pointer;width:20px;height:20px}
#msg{margin-bottom:15px}
@media(max-width:900px){.sidebar{position:relative;width:100%;height:auto}.main{margin-left:0}}
</style>
</head>
<body>

<div class="sidebar">
  <h2>CertiTrack</h2>
  <a href="admin_dashboard.php">Dashboard</a>
  <a href="upload.php">Upload Certificate</a>
  <a href="vcert.php">View Certificates</a>
  <a href="settings.php" style="background:rgba(31,79,216,.25);color:#fff">Settings</a>
  <a href="logout.php" style="color:#ffb3b3">Logout</a>
</div>

<div class="main">
  <div class="topbar">
    <h1>Settings</h1>
    <div class="profile">Admin: <?php echo $_SESSION['admin']; ?></div>
  </div>

  <div class="form-box">
    <h2>Change Password</h2>
    <div id="msg"><?php echo $msg; ?></div>
    <form method="post">
      <div class="input-group">
        <input type="password" name="current_password" placeholder="Current Password" required>
        <img src="eye.png" class="toggle-pass" alt="Toggle">
      </div>
      <div class="input-group">
        <input type="password" name="new_password" placeholder="New Password" required>
        <img src="eye.png" class="toggle-pass" alt="Toggle">
      </div>
      <div class="input-group">
        <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
        <img src="eye.png" class="toggle-pass" alt="Toggle">
      </div>
      <button type="submit" name="change_password">Update Password</button>
    </form>
  </div>
</div>

<script>
const toggleIcons = document.querySelectorAll('.toggle-pass');
toggleIcons.forEach(icon=>{
    icon.addEventListener('click', ()=>{
        const input = icon.previousElementSibling;
        if(input.type === "password"){
            input.type = "text";
            icon.src = "eye-slash.png"; // image when password is visible
        } else {
            input.type = "password";
            icon.src = "eye.png"; // image when password is hidden
        }
    });
});
</script>

</body>
</html>
