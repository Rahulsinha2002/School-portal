<?php
session_start();
include 'includes/config.php';

// Fetch notifications
$sql = "SELECT * FROM notifications ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Notification Panel</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background: #f5f6fa;
      padding: 0;
    }
    .notification-container {
      max-width: 800px;
      margin: 50px auto;
      padding: 20px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
    }
    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 30px;
      font-size: 2rem;
      font-weight: bold;
      position: relative;
      padding-left: 35px;
      transition: all 0.3s ease;
    }
    h2::before {
      content: '\f0f3';
      font-family: "Font Awesome 5 Free";
      font-weight: 900;
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 2rem;
      color: #2980b9;
    }
    h2:hover {
      color: #2980b9;
      transform: translateY(-3px);
    }
    .notification-panel {
      max-height: 500px;
      overflow-y: auto;
      padding-top: 20px;
    }
    .notification-item {
      background-color: #fff;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
      border-left: 5px solid;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      transition: all 0.3s ease-in-out;
      flex-wrap: wrap;
    }
    .notification-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    .notification-item i {
      font-size: 2rem;
      margin-right: 15px;
      color: #fff;
      background-color: #2980b9;
      padding: 12px;
      border-radius: 50%;
    }
    .notification-item h4 {
      margin: 0;
      color: #2c3e50;
      font-size: 1.3rem;
      font-weight: bold;
    }
    .notification-item p {
      margin: 10px 0;
      color: #555;
      font-size: 1rem;
      line-height: 1.5;
    }
    .notification-item small {
      color: #888;
      font-size: 0.9rem;
    }
    .notification-item a {
      color: #2980b9;
      font-weight: bold;
      text-decoration: none;
      word-break: break-word;
    }
    .notification-item a:hover {
      text-decoration: underline;
    }
    .info { border-left-color: #3498db; background-color: #eaf4fd; }
    .success { border-left-color: #2ecc71; background-color: #e3f9e5; }
    .warning { border-left-color: #f39c12; background-color: #fef2e1; }
    .error { border-left-color: #e74c3c; background-color: #f9d6d5; }
    .new-notification { background-color: #eaf4f9; border-left-color: #16a085; }

    /* Scrollbar */
    .notification-panel::-webkit-scrollbar { width: 8px; }
    .notification-panel::-webkit-scrollbar-thumb { background-color: #ccc; border-radius: 10px; }
    .notification-panel::-webkit-scrollbar-track { background-color: #f1f1f1; }

    @media screen and (max-width: 600px) {
      .notification-container { width: 95%; margin: 20px auto; padding: 10px; }
      .notification-item { flex-direction: column; align-items: flex-start; }
      .notification-item i { margin-bottom: 10px; }
      .notification-item h4 { font-size: 1.1rem; }
      .notification-item p { font-size: 0.95rem; }
      .notification-item small { font-size: 0.8rem; }
      h2 { font-size: 1.5rem; padding-left: 30px; }
      h2::before { font-size: 1.5rem; left: 5px; }
    }
  </style>
</head>
<body>

<div class="notification-container">
  <h2>Notification Panel</h2>

  <div class="notification-panel">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $new_class = (strtotime($row['created_at']) > strtotime('-24 hours')) ? 'new-notification' : '';

            $notification_class = '';
            $icon_class = '';
            if (stripos($row['title'], 'error') !== false || stripos($row['message'], 'error') !== false) {
                $notification_class = 'error'; $icon_class = 'fas fa-exclamation-circle';
            } elseif (stripos($row['title'], 'success') !== false || stripos($row['message'], 'success') !== false) {
                $notification_class = 'success'; $icon_class = 'fas fa-check-circle';
            } elseif (stripos($row['title'], 'warning') !== false || stripos($row['message'], 'warning') !== false) {
                $notification_class = 'warning'; $icon_class = 'fas fa-exclamation-triangle';
            } else {
                $notification_class = 'info'; $icon_class = 'fas fa-info-circle';
            }

            echo "<div class='notification-item $notification_class $new_class'>";
            echo "<i class='$icon_class'></i>";
            echo "<div>";
            echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
            echo "<p>" . nl2br(htmlspecialchars($row['message'])) . "</p>";
            echo "<small>From: " . $row['start_date'] . " To: " . $row['end_date'] . "</small><br>";

            if (!empty($row['file_path'])) {
                $file_path = 'uploads/' . basename($row['file_path']);
                if (file_exists($file_path)) {
                    echo "<a href='$file_path' target='_blank'>📄 View File</a>";
                } else {
                    echo "<span style='color:red;'>❌ File not found</span>";
                }
            }

            echo "</div></div>";
        }
    } else {
        echo "<p style='color: #777; text-align: center;'>No notifications available.</p>";
    }
    ?>
  </div>
</div>

</body>
</html>
