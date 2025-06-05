<?php
session_start();
include '../includes/config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$delete_message = ""; // New variable to store the message

// Handle delete request
if (isset($_POST['delete_notification'])) {
    $delete_id = $_POST['delete_id'];

    // Fetch file path for deletion
    $stmt = $conn->prepare("SELECT file_path FROM notifications WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->bind_result($file_path);
    $stmt->fetch();
    $stmt->close();

    if (!empty($file_path) && file_exists($file_path)) {
        unlink($file_path);
    }

    $stmt = $conn->prepare("DELETE FROM notifications WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();

    $delete_message = "<p style='color: red; font-weight: bold; text-align: center;'>🗑 Notification deleted successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background: #f0f2f5;
    }

    .dashboard-container {
      max-width: 1000px;
      margin: 80px auto 40px; /* Added top margin to avoid overlapping navbar */
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    h2, h3 {
      color: #2c3e50;
      margin-bottom: 15px;
    }

    form {
      margin-bottom: 30px;
    }

    input[type="text"],
    input[type="date"],
    input[type="file"],
    textarea {
      width: 100%;
      padding: 10px;
      margin-top: 8px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }

    button {
      background-color: #3498db;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 1rem;
    }

    button:hover {
      background-color: #2980b9;
    }

    .notification-list {
      max-height: 400px;
      overflow-y: auto;
      border-top: 1px solid #ddd;
      padding-top: 20px;
    }

    .notification-item {
      padding: 15px;
      border-bottom: 1px solid #eee;
    }

    .notification-item:last-child {
      border-bottom: none;
    }

    .notification-item h4 {
      margin: 0 0 8px;
      color: #34495e;
    }

    .notification-item p {
      margin: 0 0 6px;
      color: #555;
    }

    .notification-item small {
      color: #888;
    }

    .notification-item a {
      display: inline-block;
      margin-top: 6px;
      color: #2980b9;
      font-weight: bold;
      text-decoration: none;
    }

    .notification-item a:hover {
      text-decoration: underline;
    }

    .delete-btn {
      margin-top: 8px;
      background-color: #e74c3c;
      color: white;
      padding: 8px 14px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .delete-btn:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>

  <?php include('../includes/admin_navbar.html'); ?>

  <div class="dashboard-container">
    <h2>Welcome to Admin Dashboard</h2>

    <!-- Add Notification Form -->
    <h3>Add Notification</h3>
    <form action="admin_dashboard.php" method="POST" enctype="multipart/form-data">
      <label>Title</label>
      <input type="text" name="title" placeholder="Notification Title" required>

      <label>Message</label>
      <textarea name="message" rows="4" placeholder="Notification message..." required></textarea>

      <label>Start Date</label>
      <input type="date" name="start_date">

      <label>End Date</label>
      <input type="date" name="end_date">

      <label>Attach File (optional)</label>
      <input type="file" name="file_path">

      <button type="submit" name="submit_notification">Add Notification</button>
    </form>

    <!-- PHP: Handle Form Submission -->
    <?php
    if (isset($_POST['submit_notification'])) {
        $title = $_POST['title'];
        $message = $_POST['message'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $file_path = "";

        if ($_FILES['file_path']['name']) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["file_path"]["name"]);
            move_uploaded_file($_FILES["file_path"]["tmp_name"], $target_file);
            $file_path = $target_file;
        }

        $sql = "INSERT INTO notifications (title, message, start_date, end_date, file_path) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $title, $message, $start_date, $end_date, $file_path);
        $stmt->execute();
        echo "<p style='color: green; font-weight: bold;'>✅ Notification added successfully!</p>";
    }
    ?>

    <!-- Notification List -->
    <h3>All Notifications</h3>

    <?php
    // ✅ Display message inside panel
    if (!empty($delete_message)) {
        echo $delete_message;
    }
    ?>

    <div class="notification-list">
      <?php
      $sql = "SELECT * FROM notifications ORDER BY created_at DESC";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<div class='notification-item'>";
              echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
              echo "<p>" . nl2br(htmlspecialchars($row['message'])) . "</p>";
              echo "<small>From: " . $row['start_date'] . " To: " . $row['end_date'] . "</small><br>";
              if ($row['file_path']) {
                  echo "<a href='" . $row['file_path'] . "' target='_blank'>📄 View File</a>";
              }
              echo "<form method='POST' onsubmit='return confirm(\"Are you sure you want to delete this notification?\");'>";
              echo "<input type='hidden' name='delete_id' value='" . $row['id'] . "'>";
              echo "<button type='submit' name='delete_notification' class='delete-btn'>🗑 Delete</button>";
              echo "</form>";
              echo "</div>";
          }
      } else {
          echo "<p style='color: #777;'>No notifications available.</p>";
      }
      ?>
    </div>
  </div>

</body>
</html>
