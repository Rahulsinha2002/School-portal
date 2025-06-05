<?php
include '../includes/config.php';
// include '../includes/admin_navbar.html';
$class_filter = '';
$result = null;

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

        .error-msg {
            color: red;
            margin-top: 8px;
        }
    </style>
</head>
<body>
<?php include('../includes/admin_navbar.html'); ?>

<div class="container">
    <h2>📖 View Homework / Assignments</h2>

    <form method="POST">
        <label for="class">Select Class:</label>
        <select name="class" id="class" required>
            <option value="">-- Choose Class --</option>
            <?php
            $classes = [
                "Class 1", "Class 2", "Class 3", "Class 4", "Class 5",
                "Class 6", "Class 7", "Class 8", "Class 9", "Class 10",
                "Class 11(sci)", "Class 11(comr.)", "Class 12(sci)", "Class 12(comr.)"
            ];
            foreach ($classes as $class) {
                $selected = ($class_filter == $class) ? 'selected' : '';
                echo "<option value='$class' $selected>$class</option>";
            }
            ?>
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
                echo "<p><strong>Due Date:</strong> " . htmlspecialchars($row['due_date']) . "</p>";
                echo "<p>" . nl2br(htmlspecialchars($row['description'])) . "</p>";

                if (!empty($row['file_name'])) {
                    $file = $row['file_name'];
                    $browserPath = "../uploads/homework/" . $file;
                    $serverPath = __DIR__ . "/../uploads/homework/" . $file;

                    if (file_exists($serverPath)) {
                        echo "<a class='download-btn' href='$browserPath' target='_blank'>📄 Download File</a>";
                    } else {
                        echo "<p class='error-msg'>❌ File not found. ($browserPath)</p>";
                    }
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
