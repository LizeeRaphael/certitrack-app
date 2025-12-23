<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload Certificate | CertiTrack</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--gold:#d4af37}
*{box-sizing:border-box}
body{margin:0;font-family:Poppins,sans-serif;background:linear-gradient(135deg,#050509,#0d1325);color:#fff}
.sidebar{width:240px;height:100vh;position:fixed;background:#070711;padding:25px 20px}
.sidebar h2{color:var(--gold);text-align:center;margin-bottom:35px}
.sidebar a{display:block;padding:14px 16px;margin-bottom:12px;color:#cfd8ff;text-decoration:none;border-radius:10px}
.sidebar a:hover{background:rgba(31,79,216,.25)}
.main{margin-left:240px;padding:35px}
.topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:30px}
.profile{background:rgba(255,255,255,.08);padding:10px 18px;border-radius:30px}
.form-box{max-width:720px;background:rgba(255,255,255,.08);padding:35px;border-radius:20px}
input,button{width:100%;padding:14px;margin-bottom:15px;border-radius:10px;border:none}
input{background:#0e1535;color:#fff}
button{background:linear-gradient(135deg,#d4af37,#f5d76e);font-weight:600}
#msg{margin-bottom:15px}
</style>
</head>
<body>

<div class="sidebar">
  <h2>CertiTrack</h2>
  <a href="admin_dashboard.php">Dashboard</a>
  <a href="upload.php">Upload Certificate</a>
  <a href="vcert.php">View Certificates</a>
  <a href="logout.php" style="color:#ffb3b3">Logout</a>
</div>

<div class="main">
  <div class="topbar">
    <h1>Upload Certificate</h1>
    <div class="profile">Admin: <?php echo $_SESSION['admin']; ?></div>
  </div>

  <div class="form-box">
    <div id="msg"></div>

    <form id="uploadForm" enctype="multipart/form-data">
      <input type="text" name="certificate_no" placeholder="Certificate Number" required>
      <input type="text" name="holder_name" placeholder="Holder Full Name" required>
      <input type="text" name="course" placeholder="Course / Program" required>
      <input type="date" name="issue_date" required>
      <input type="file" name="certificate_pdf" accept="application/pdf" required>
      <button type="submit">Upload Certificate</button>
    </form>
  </div>
</div>

<script>
document.getElementById('uploadForm').addEventListener('submit', function(e){
    e.preventDefault();
    const form = this;
    const formData = new FormData(form);
    const msg = document.getElementById('msg');
    msg.innerHTML = '';

    // Step 1: Check if certificate exists
    fetch('check_certificate.php', {
        method: 'POST',
        body: new URLSearchParams({ certificate_no: formData.get('certificate_no') })
    })
    .then(res => res.json())
    .then(data => {
        if (data.exists) {
            const proceed = confirm('Certificate number already exists. Continue upload?');
            if (!proceed) return;
            formData.append('force_upload', '1'); // add force flag
        }

        // Step 2: Upload
        fetch('upload_certificate_ajax.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if(res.status === 'success'){
                msg.innerHTML = `<span style="color:#9affb1">${res.message}</span>`;
                form.reset();
            } else {
                msg.innerHTML = `<span style="color:#ffb3b3">${res.message}</span>`;
            }
        })
        .catch(()=>{ msg.innerHTML = '<span style="color:#ffb3b3">Upload failed</span>'; });
    })
    .catch(()=>{ msg.innerHTML = '<span style="color:#ffb3b3">Check failed</span>'; });
});
</script>


</body>
</html>
