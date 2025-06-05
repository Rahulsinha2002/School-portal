<?php
session_start();
include '../includes/config.php';
include '../includes/admin_navbar.html';

// Fetch classes
$class_result = $conn->query("SELECT * FROM classes ORDER BY sort_order ASC");

// Handle form submission
$message = "";
if (isset($_POST['submit_attendance'])) {
    $class_id = $_POST['class_id'];
    $date = $_POST['attendance_date']; // Use selected date

    $already_marked = false;

    foreach ($_POST['attendance'] as $student_id => $status) {
        // Prevent duplicate entries
        $check = $conn->prepare("SELECT COUNT(*) FROM attendance WHERE student_id = ? AND date = ?");
        $check->bind_param("is", $student_id, $date);
        $check->execute();
        $check_result = $check->get_result();
        $exists = $check_result->fetch_row()[0];

        if ($exists) {
            $already_marked = true;
            break; // stop further processing if attendance exists
        }
    }

    if ($already_marked) {
        $message = "⚠️ Attendance has already been marked for $date!";
    } else {
        foreach ($_POST['attendance'] as $student_id => $status) {
            $stmt = $conn->prepare("INSERT INTO attendance (student_id, class_id, date, status) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $student_id, $class_id, $date, $status);
            $stmt->execute();
        }
        $message = "✅ Attendance marked successfully for $date!";
    }
}

// Fetch students if class selected
$selected_class_id = isset($_GET['class_id']) ? $_GET['class_id'] : '';
$students = [];

if (!empty($selected_class_id)) {
    $stmt = $conn->prepare("SELECT id, name FROM students WHERE class_id = ?");
    $stmt->bind_param("s", $selected_class_id);
    $stmt->execute();
    $students = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mark Attendance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background: #f0f2f5;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        form {
            margin-top: 20px;
        }

        select, input[type="date"], button {
            padding: 10px;
            margin: 10px 0;
            border-radius: 6px;
            font-size: 1rem;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        .message {
            text-align: center;
            color: green;
            margin-top: 15px;
            font-weight: bold;
        }

        .message.warning {
            color: #d35400;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Mark Attendance</h2>

    <?php if (!empty($message)): ?>
        <p class='message <?= strpos($message, '⚠️') !== false ? 'warning' : '' ?>'><?= $message ?></p>
    <?php endif; ?>

    <form method="GET">
        <label for="class_id">Select Class:</label>
        <select name="class_id" required>
            <option value="">-- Select Class --</option>
            <?php while ($row = $class_result->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>" <?= $selected_class_id == $row['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($row['name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Load Students</button>
    </form>

    <?php if (!empty($students)): ?>
        <form method="POST">
            <input type="hidden" name="class_id" value="<?= htmlspecialchars($selected_class_id) ?>">

            <label for="attendance_date">Select Date:</label>
            <input type="date" name="attendance_date" required value="<?= date('Y-m-d') ?>">

            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Present</th>
                        <th>Absent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $stu): ?>
                        <tr>
                            <td><?= $stu['id'] ?></td>
                            <td><?= htmlspecialchars($stu['name']) ?></td>
                            <td><input type="radio" name="attendance[<?= $stu['id'] ?>]" value="Present" required></td>
                            <td><input type="radio" name="attendance[<?= $stu['id'] ?>]" value="Absent"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" name="submit_attendance">Submit Attendance</button>
        </form>
    <?php elseif ($selected_class_id): ?>
        <p style="text-align: center; color: #888;">No students found in this class.</p>
    <?php endif; ?>
</div>
</body>
</html>
