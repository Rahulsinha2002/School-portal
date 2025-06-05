<?php
session_start();
include '../includes/config.php';

$error = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password); // Ideally use hashed passwords
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Login</title>
    <style>
        
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            text-align: center;
        }
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
        /* Login Container */
        .login-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }

        /* School Logo */
        .logo-container {
            margin-bottom: 20px;
        }

        .school-logo {
            width: 150px;
            height: auto;
        }

        /* Heading */
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
        }

        /* Input Group */
        .input-group {
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        /* Login Button */
        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #3F51B5;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #45a049;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .login-container {
                padding: 30px;
                width: 90%;
            }

            .school-logo {
                width: 120px;
            }
        }
    
       
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
    </style>
</head>
<body>
<video autoplay muted loop class="video-bg">
  <source src="../assets/logivideo.webm" type="video/mp4">
  Your browser does not support the video tag.
</video>
        <!-- School Logo -->
       
    <div class="login-container">
    <div class="logo-container">
            <img src="../assets/logo.jpg" alt="School Logo" class="school-logo">
        </div>
        <h2>Admin Login</h2>

        <!-- Error Message -->
        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="POST" action="">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>

</body>
</html>
