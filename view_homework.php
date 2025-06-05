<?php
include '../includes/config.php'; // DB connection

$class_filter = '';
if (isset($_POST['class'])) {
    $class_filter = $_POST['class'];
    $stmt = $conn->prepare("SELECT * FROM homework WHERE class = ? ORDER BY due_date ASC");
    $stmt->bind_param("s", $class_filter);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>📚 View Homework</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            padding: 30px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        select, button {
            padding: 10px;
            font-size: 16px;
            margin-right: 10px;
            border-radius: 5px;
        }

        .homework-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 6px;
        }

        .homework-item h4 {
            margin: 0 0 8px;
            color: #2980b9;
        }

        .homework-item p {
            margin: 0 0 5px;
        }

        .download-btn {
            background-color: #27ae60;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-top: 10px;
        }

        .download-btn:hover {
            background-color: #1e8449;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📖 View Homework / Assignments</h2>

    <form method="POST">
        <label for="class">Select Class:</label>
        <select name="class" id="class" required>
            <option value="">-- Choose Class --</option>
            <option value="Class 1" <?= $class_filter == 'Class 1' ? 'selected' : '' ?>>Class 1</option>
            <option value="Class 2" <?= $class_filter == 'Class 2' ? 'selected' : '' ?>>Class 2</option>
            <option value="Class 3" <?= $class_filter == 'Class 3' ? 'selected' : '' ?>>Class 3</option>
            <option value="Class 4" <?= $class_filter == 'Class 4' ? 'selected' : '' ?>>Class 4</option>
            <option value="Class 5" <?= $class_filter == 'Class 5' ? 'selected' : '' ?>>Class 5</option>
            <option value="Class 6" <?= $class_filter == 'Class 6' ? 'selected' : '' ?>>Class 6</option>
            <option value="Class 7" <?= $class_filter == 'Class 7' ? 'selected' : '' ?>>Class 7</option>
            <option value="Class 8" <?= $class_filter == 'Class 8' ? 'selected' : '' ?>>Class 8</option>
            <option value="Class 9" <?= $class_filter == 'Class 9' ? 'selected' : '' ?>>Class 9</option>
            <option value="Class 10" <?= $class_filter == 'Class 10' ? 'selected' : '' ?>>Class 10</option>
            <option value="Class 11(sci)" <?= $class_filter == 'Class 11(sci)' ? 'selected' : '' ?>>Class 11(sci)</option>
            <option value="Class 11(comr.) " <?= $class_filter == 'Class 11(comr.)' ? 'selected' : '' ?>>Class 11(comr.)</option>
            <option value="Class 12(sci) " <?= $class_filter == 'Class 12(sci)' ? 'selected' : '' ?>>Class 12(sci)</option>
            <option value="Class 12(comr.) " <?= $class_filter == 'Class 12(comr.)' ? 'selected' : '' ?>>Class 12(comr.)</option>
            <!-- Add more if needed -->
        </select>
        <button type="submit">Show Homework</button>
    </form>

    <br>

    <?php
    if (isset($result)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='homework-item'>";
                echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
                echo "<p><strong>Due Date:</strong> " . $row['due_date'] . "</p>";
                echo "<p>" . nl2br(htmlspecialchars($row['description'])) . "</p>";
                if (!empty($row['file_path'])) {
                    echo "<a class='download-btn' href='" . $row['file_path'] . "' target='_blank'>📄 Download File</a>";
                }
                echo "</div>";
            }
        } else {
            echo "<p>No homework found for this class.</p>";
        }
    }
    ?>
</div>

</body>
</html>
