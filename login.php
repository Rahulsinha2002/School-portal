<?php
// (Optional) PHP part - blank for now
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin-Login</title>

  <!-- ✅ Font Awesome CDN for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    /* ✅ Global Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: rgba(0, 0, 0, 0.94);
      overflow: hidden;
      position: relative;
    }

    /* ✅ Video Background */
    .video-bg {
      position: fixed;
      top: 0;
      left: 0;
      min-width: 100%;
      min-height: 100%;
      z-index: -1;
      object-fit: cover;
      opacity: 0.6;
    }

    /* ✅ Login Container */
    .login-container {
      background-color: rgb(255, 253, 253);
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.91);
      padding: 40px 30px;
      width: 100%;
      max-width: 400px;
      text-align: center;
      z-index: 1;
    }

    /* ✅ Logo Styling */
    .logo-container {
      margin-bottom: 20px;
    }
    .school-logo {
      width: 140px;
      height: auto;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(53, 44, 225, 0.78);
    }

    /* ✅ Headings */
    h2 {
      font-size: 26px;
      color: #333;
      margin-bottom: 25px;
      font-weight: 600;
    }

    /* ✅ Input Group */
    .input-group {
      margin-bottom: 20px;
      position: relative;
    }

    input {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      background-color: rgb(186, 187, 188);
      transition: border 0.3s ease, background-color 0.3s ease;
    }

    input:focus {
      border-color: #2575fc;
      outline: none;
      background-color: #ffffff;
    }

    .toggle-password {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #333;
    }

    /* ✅ Buttons */
    .login-btn, .fingerprint-btn {
      width: 100%;
      padding: 12px;
      border: none;
      color: white;
      font-size: 17px;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease;
      margin-top: 10px;
    }

    .login-btn {
      background: #2575fc;
    }
    .login-btn:hover {
      background: #1a5fd6;
    }

    .fingerprint-btn {
      background: #28a745;
    }
    .fingerprint-btn:hover {
      background: #218838;
    }

    /* ✅ Responsive */
    @media (max-width: 480px) {
      body {
        padding: 25px;
      }
      .login-container {
        padding: 30px 20px;
      }
      .school-logo {
        width: 120px;
      }
    }
  </style>
</head>

<body>

<!-- ✅ Background Video -->
<video autoplay muted loop class="video-bg">
  <source src="../assets/logivideo.webm" type="video/mp4">
  Your browser does not support the video tag.
</video>

<!-- ✅ Login Form Container -->
<div class="login-container">
  <div class="logo-container">
    <img src="../assets/logo.jpg" alt="School Logo" class="school-logo">
  </div>

  <h2>Admin Login</h2>

  <form id="loginForm" action="process_login.php" method="POST">
    <div class="input-group">
      <input type="text" id="username" name="username" placeholder="Username" required>
    </div>

    <div class="input-group">
      <input type="password" id="password" name="password" placeholder="Password" required>
      <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
    </div>

    <button type="submit" class="login-btn">Login</button>

    
   
  </form>
</div>

<!-- ✅ JavaScript for Password Toggle and Fingerprint -->
<script>
  const togglePassword = document.getElementById('togglePassword');
  const password = document.getElementById('password');

  togglePassword.addEventListener('click', function () {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
  });

  
  
</script>

</body>
</html>
