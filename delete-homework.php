<?php
include '../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $conn->query("DELETE FROM homework WHERE id = $id");
    echo "success";
} else {
    echo "error";
}
?>
