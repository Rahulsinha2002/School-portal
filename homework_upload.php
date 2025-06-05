<?php
session_start();
include '../includes/config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}

$success_msg = '';
$error_msg = '';
$classes = ["Class 1", "Class 2", "Class 3", "Class 4", "Class 5", "Class 6", "Class 7", "Class 8", "Class 9", "Class 10", "Class 11(sci)", "Class 11(comr.)", "Class 12(sci)", "Class 12(comr.)"];

if (isset($_POST['submit_homework'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $class = $_POST['class'];
    $due_date = $_POST['due_date'];
    $file_name = '';

    if (isset($_FILES['homework_file']) && $_FILES['homework_file']['error'] === UPLOAD_ERR_OK) {
        $original = basename($_FILES['homework_file']['name']);
        $safe = preg_replace("/[^a-zA-Z0-9\.-]/", "_", $original);
        $tmp = $_FILES['homework_file']['tmp_name'];

        $dir = "../uploads/homework/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);
        $path = $dir . $safe;
        $i = 1;
        while (file_exists($path)) {
            $path = $dir . pathinfo($safe, PATHINFO_FILENAME) . "_$i." . pathinfo($safe, PATHINFO_EXTENSION);
            $i++;
        }

        $file_name = basename($path);
        move_uploaded_file($tmp, $path);
    }

    $stmt = $conn->prepare("INSERT INTO homework (title, description, class, due_date, file_name) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $description, $class, $due_date, $file_name);
    $success_msg = $stmt->execute() ? "✅ Homework uploaded successfully!" : "❌ Failed to upload homework!";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM homework WHERE id = ?");
    $stmt->bind_param("i", $id);
    echo $stmt->execute() ? "success" : "error";
    exit;
}

$selected_class = $_POST['class_filter'] ?? '';
if ($selected_class) {
    $stmt = $conn->prepare("SELECT * FROM homework WHERE class = ? ORDER BY due_date DESC");
    $stmt->bind_param("s", $selected_class);
    $stmt->execute();
    $homework_data = $stmt->get_result();
} else {
    $homework_data = $conn->query("SELECT * FROM homework ORDER BY class, due_date DESC");
}

$homework_by_class = [];
while ($row = $homework_data->fetch_assoc()) {
    $homework_by_class[$row['class']][] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Homework Upload</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f6fa;
            margin: 0; padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        }
        h2, h3, h4 {
            text-align: center;
            color: #2c3e50;
        }
        label { font-weight: 500; margin-top: 15px; display: block; }
        input, select, textarea {
            width: 100%; padding: 10px; margin-top: 6px;
            border-radius: 6px; border: 1px solid #ccc; font-size: 16px;
        }
        button {
            background-color: #3498db; color: white;
            padding: 12px 20px; border: none;
            border-radius: 6px; cursor: pointer; margin-top: 20px; font-size: 16px;
        }
        button:hover { background-color: #2980b9; }
        .message.success {
            background: #eafaf1; color: #27ae60;
            border: 1px solid #27ae60; padding: 10px;
            text-align: center; margin: 20px 0; border-radius: 6px;
        }
        .message.error {
            background: #fdecea; color: #e74c3c;
            border: 1px solid #e74c3c; padding: 10px;
            text-align: center; margin: 20px 0; border-radius: 6px;
        }
        .filter-class {
            text-align: center; margin: 30px 0;
        }

        .homework-section {
            margin-top: 40px;
        }
        .class-header {
            font-size: 22px;
            color: #333;
            margin: 20px 0 10px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 6px;
        }
        .homework-card {
            background: #fdfdfd;
            border-radius: 8px;
            padding: 16px 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
            transition: 0.3s ease;
            position: relative;
        }
        .homework-card:hover {
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }
        .homework-card h4 {
            margin: 0 0 6px;
            font-size: 18px;
            color: #2c3e50;
        }
        .homework-card p {
            margin: 4px 0;
            color: #555;
        }
        .homework-card a {
            color: #3498db;
            text-decoration: none;
        }
        .delete-btn {
            background: #e74c3c; color: white;
            padding: 6px 10px;
            border: none; border-radius: 4px;
            cursor: pointer; font-size: 14px;
            position: absolute; top: 16px; right: 16px;
        }
        .delete-btn:hover { background: #c0392b; }
    </style>
</head>
<body>

<?php include('../includes/admin_navbar.html'); ?>

<div class="container">
    <h2>📘 Upload Homework</h2>

    <?php if ($success_msg): ?>
        <div class="message success"><?= $success_msg ?></div>
    <?php elseif ($error_msg): ?>
        <div class="message error"><?= $error_msg ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Title</label>
        <input type="text" name="title" required>

        <label>Description</label>
        <textarea name="description" rows="4" required></textarea>

        <label>Class</label>
        <select name="class" required>
            <option value="">-- Select Class --</option>
            <?php foreach ($classes as $cls): ?>
                <option value="<?= $cls ?>"><?= $cls ?></option>
            <?php endforeach; ?>
        </select>

        <label>Due Date</label>
        <input type="date" name="due_date" required>

        <label>Upload File</label>
        <input type="file" name="homework_file" accept=".pdf,.doc,.docx">

        <button type="submit" name="submit_homework">Upload Homework</button>
    </form>

    <div class="filter-class">
        <form method="POST">
            <label>Filter by Class</label>
            <select name="class_filter" onchange="this.form.submit()">
                <option value="">-- All Classes --</option>
                <?php foreach ($classes as $cls): ?>
                    <option value="<?= $cls ?>" <?= ($selected_class === $cls) ? 'selected' : '' ?>><?= $cls ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <div class="homework-section">
        <h3>📂 Existing Homework</h3>
        <?php foreach ($homework_by_class as $class => $list): ?>
            <?php if ($selected_class && $selected_class !== $class) continue; ?>
            <div class="class-header">📎 <?= $class ?></div>
            <?php foreach ($list as $hw): ?>
                <div class="homework-card" id="hw-<?= $hw['id'] ?>">
                    <h4><?= htmlspecialchars($hw['title']) ?> (Due: <?= $hw['due_date'] ?>)</h4>
                    <p><?= htmlspecialchars($hw['description']) ?></p>
                    <?php if ($hw['file_name']): ?>
                        <p><a href="../uploads/homework/<?= htmlspecialchars($hw['file_name']) ?>" target="_blank">📄 View File</a></p>
                    <?php endif; ?>
                    <button class="delete-btn" onclick="deleteHomework(<?= $hw['id'] ?>)">Delete</button>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>

<script>
function deleteHomework(id) {
    if (confirm("Are you sure you want to delete this homework?")) {
        fetch("", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "delete_id=" + id
        })
        .then(res => res.text())
        .then(data => {
            if (data.trim() === "success") {
                document.getElementById("hw-" + id).remove();
            } else {
                alert("Failed to delete.");
            }
        });
    }
}

document.querySelector('input[name="homework_file"]').addEventListener('change', function() {
    const maxSize = 5 * 1024 * 1024; // 5MB
    if (this.files[0] && this.files[0].size > maxSize) {
        alert("File must be less than 5MB.");
        this.value = "";
    }
});
</script>

</body>
</html>
