<?php
session_start();
include 'db.php';

$msg = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn,
        "SELECT * FROM admin_users WHERE email='$email' AND password='$password'"
    );

    if(mysqli_num_rows($query) === 1){
        $_SESSION['admin'] = $email;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $msg = "Invalid login details";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{
    background:linear-gradient(135deg,#050509,#0d1325);
    font-family:Poppins,sans-serif;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    color:#fff;
}
.login-box{
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(15px);
    padding:40px;
    width:360px;
    border-radius:18px;
    box-shadow:0 20px 50px rgba(0,0,0,.7);
}
.login-box h2{
    text-align:center;
    color:#d4af37;
    margin-bottom:25px;
}
.login-box input{
    width:100%;
    padding:14px;
    margin-bottom:15px;
    border:none;
    border-radius:10px;
    background:#0e1535;
    color:#fff;
}
.login-box button{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    font-weight:600;
    background:linear-gradient(135deg,#d4af37,#f5d76e);
    cursor:pointer;
}
.error{
    text-align:center;
    color:#ffb3b3;
    margin-bottom:10px;
}
</style>
</head>
<body>

<div class="login-box">
    <h2>Admin Login</h2>
    <?php if($msg) echo "<div class='error'>$msg</div>"; ?>
    <form method="post">
        <input type="email" name="email" placeholder="Admin Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
