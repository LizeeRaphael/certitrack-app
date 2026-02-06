<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Certificate Tracker</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --black:#0b0b0d;
      --gold:#d4af37;
      --blue:#1f4fd8;
      --white:#ffffff;
      --glass: rgba(255,255,255,0.08);
    }

    *{box-sizing:border-box;margin:0;padding:0}
    body{
      font-family:'Poppins',sans-serif;
      background:linear-gradient(135deg,#050509,#0d1325,#050509);
      color:var(--white);
      min-height:100vh;
    }

    header{
      display:flex;
      justify-content:space-between;
      align-items:center;
      padding:24px 60px;
    }

    .logo{
      font-size:24px;
      font-weight:700;
      color:var(--gold);
      letter-spacing:1px;
    }

    nav a{
      color:#cfd8ff;
      margin-left:28px;
      text-decoration:none;
      font-weight:500;
    }

    nav a:hover{color:var(--gold)}

    .hero{
      display:grid;
      grid-template-columns:1.2fr 1fr;
      gap:60px;
      padding:80px 60px;
      align-items:center;
    }

    .hero-text h1{
      font-size:52px;
      line-height:1.15;
      margin-bottom:20px;
    }

    .hero-text h1 span{color:var(--gold)}

    .hero-text p{
      color:#c7ccff;
      font-size:17px;
      max-width:520px;
      margin-bottom:40px;
    }

    .track-box{
      background:linear-gradient(180deg,rgba(255,255,255,0.12),rgba(255,255,255,0.03));
      backdrop-filter:blur(14px);
      border-radius:20px;
      padding:40px;
      box-shadow:0 20px 60px rgba(0,0,0,0.6);
      border:1px solid rgba(255,255,255,0.15);
    }

    .track-box h3{
      font-size:24px;
      margin-bottom:10px;
      color:var(--gold);
    }

    .track-box p{
      font-size:14px;
      color:#d6dbff;
      margin-bottom:25px;
    }

    .track-box input{
      width:100%;
      padding:16px 18px;
      border-radius:12px;
      border:none;
      outline:none;
      font-size:15px;
      background:#0e1535;
      color:#fff;
      margin-bottom:18px;
    }

    .track-box input::placeholder{color:#8f98ff}

    .track-box button{
      width:100%;
      padding:16px;
      font-size:16px;
      border-radius:14px;
      border:none;
      background:linear-gradient(135deg,var(--gold),#f5d76e);
      color:#111;
      font-weight:600;
      cursor:pointer;
      transition:all .3s ease;
    }

    .track-box button:hover{
      transform:translateY(-2px);
      box-shadow:0 12px 30px rgba(212,175,55,0.45);
    }

    .features{
      display:grid;
      grid-template-columns:repeat(3,1fr);
      gap:30px;
      padding:0 60px 80px;
    }

    .feature{
      background:var(--glass);
      border-radius:18px;
      padding:30px;
      border:1px solid rgba(255,255,255,0.12);
      transition:.3s;
    }

    .feature:hover{
      transform:translateY(-6px);
      box-shadow:0 20px 50px rgba(0,0,0,0.5);
    }

    .feature h4{
      color:var(--gold);
      margin-bottom:12px;
      font-size:18px;
    }

    .feature p{
      font-size:14px;
      color:#cbd2ff;
    }

    footer{
      text-align:center;
      padding:30px;
      font-size:13px;
      color:#9aa3ff;
      border-top:1px solid rgba(255,255,255,0.1);
    }

    @media(max-width:900px){
      .hero{grid-template-columns:1fr;padding:50px 24px}
      header{padding:20px 24px}
      .features{grid-template-columns:1fr;padding:0 24px 60px}
    }
  </style>
</head>
<body>

<header>
  <div class="logo">CertiTrack</div>
  <nav>
    <a href="#">Home</a>
    <a href="#">Verify</a>
    <a href="#">About</a>
    <a href="#">Contact</a>
  </nav>
</header>

<section class="hero">
  <div class="hero-text">
    <h1>Verify & Track<br><span>Certificates Instantly</span></h1>
    <p>
      CertiTrack is a secure certificate tracking platform that allows individuals and organizations to instantly verify certificates using a certificate number or holder name.
    </p>
  </div>

  <div class="track-box">
    <h3>Track Certificate</h3>
    <p>Enter certificate number or holder name below</p>
    <form method="POST" action="track.php">
      <input type="text" name="query" placeholder="Certificate Number or Full Name" required />
      <button type="submit">Track Certificate</button>
    </form>
  </div>
</section>

<section class="features">
  <div class="feature">
    <h4>🔐 Secure Verification</h4>
    <p>All certificates are validated against our encrypted database to ensure authenticity.</p>
  </div>
  <div class="feature">
    <h4>⚡ Instant Results</h4>
    <p>Get certificate details within seconds by entering a name or certificate ID.</p>
  </div>
  <div class="feature">
    <h4>🌍 Global Access</h4>
    <p>Accessible from anywhere in the world on any device, anytime.</p>
  </div>
</section>

<footer>
  © <?php echo date('Y'); ?> CertiTrack Platform. Rights reserved.
</footer>

</body>
</html>
