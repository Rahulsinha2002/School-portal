<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard</title>
  <style>
    /* General Styles */
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f9;
      display: flex;
      flex-direction: column;
      
    }

    /* Navbar Styles */
    .navbar {
      background-color: #1abc9c;
      color: white;
      padding: 15px 20px;
      font-size: 1.3rem;
      font-weight: bold;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
    }

    .navbar .logo {
      font-size: 1.6rem;
      font-weight: 700;
    }

    /* Sidebar Styles */
    .sidebar {
      font-size: 1.3rem;
      width: 250px;
      background-color: #2c3e50;
      color: white;
      display: flex;
      flex-direction: column;
      padding-top: 20px;
      transition: width 0.3s;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      z-index: 900;
    }

    .sidebar a, .sidebar button {
      background: none;
      border: none;
      color: white;
      padding: 15px;
      text-align: left;
      width: 100%;
      cursor: pointer;
      font-size: 1.2rem;
      transition: background 0.3s;
      text-decoration: none;
      display: block;
    }

    .sidebar button:hover,
    .sidebar a:hover {
      background-color: #34495e;
    }

    /* Main Content */
    .content {
      margin-top: 50px; /* Avoid navbar overlap */
      margin-left: 250px;
      padding: 50px;
      flex-grow: 1;
      background-color: #fff;
      min-height: 100dvh;
      box-sizing: border-box;
    }

    .content h2 {
      color: #333;
      margin-bottom: 20px;
    }

    /* Fully Responsive Grid Layout */
    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Default grid layout */
      gap: 1.5rem;
      margin-top: 2rem;
    }

    .card-button {
      background-color: #f0f4ff;
      border: 2px solid #4a90e2;
      border-radius: 12px;
      padding: 1.5rem 2rem;
      font-size: 1.2rem;
      font-weight: 500;
      color: #333;
      cursor: pointer;
      transition: all 0.3s ease;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      text-decoration: none;
      display: block;
    }

    .card-button:hover {
      background-color: #4a90e2;
      color: #fff;
      transform: translateY(-3px);
    }

    /* Mobile View Styles */
    @media (max-width: 768px) {
      /* Sidebar Hidden on Mobile */
      .sidebar {
        display: none !important;
        grid-template-columns: 1fr 1fr;
      }

      /* Navbar on Mobile */
      .navbar {
        padding: 25px;
      }

      /* Mobile Content */
      .content {
        margin-top: 90px;
        margin-left: 0;
        padding: 20px;
       
        
      }

      /* Mobile Grid */
      .card-grid {
        grid-template-columns: 1fr 1fr; /* 2 Columns on small screens */
      }
    }

    /* Tablet View */
    @media (max-width: 1024px) {
      .card-grid {
        grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); /* More responsive for tablets */
      }
    }

    /* Hide hamburger button on mobile */
    .menu-btn {
      display: none;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <div class="logo">🏫 Aryavart Academy-Student Dashboard</div>
  </div>

  <!-- Sidebar (for larger screens) -->
  <div class="sidebar" id="sidebar">
    <a href="users/form.php">📝 Admission</a>
    <a href="users/view_homework.php">📚 Homework</a>
    <a href="timetable.html">📅 Timetable</a>
    <button onclick="loadPage('notification.php')">📢 Notifications</button>
  </div>

  <!-- Main Content -->
  <div class="content" id="mainContent">
    <h2>Welcome to the Student Dashboard</h2>
    <p>We hope you're having a great day. Here's a quick glance at your updates and tasks.</p>

    <!-- Card Grid -->
    <div class="card-grid">
      <a href="users/form.php" class="card-button">📝 Admission</a>
      <a href="users/view_homework.php" class="card-button">📚 Homework</a>
      <a href="timetable.html" class="card-button">📅 Timetable</a>
      <button onclick="loadPage('notification.php')" class="card-button">📢 Notifications</button>
    </div>
  </div>

  <script>
    // Function to load content dynamically
    function loadPage(pageUrl) {
      fetch(pageUrl)
        .then(response => response.text())
        .then(data => {
          document.getElementById("mainContent").innerHTML = data;
        })
        .catch(error => {
          document.getElementById("mainContent").innerHTML = "<p>Error loading content.</p>";
          console.error("Load error:", error);
        });
    }
  </script>

</body>
</html>
