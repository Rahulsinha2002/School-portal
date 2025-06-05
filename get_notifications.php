<?php
include 'includes/config.php';

$sql = "SELECT title, message, start_date, end_date, file_path FROM notifications WHERE is_active = 1 ORDER BY created_at DESC";
$result = $conn->query($sql);

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

echo json_encode($notification);
?>
