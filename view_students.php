<?php
session_start();
include '../includes/config.php';
include '../includes/admin_navbar.html';

// Fetch classes for dropdown
$class_result = $conn->query("SELECT * FROM classes ORDER BY sort_order ASC");

// Handle selected class
$selected_class_id = isset($_GET['class_id']) ? $_GET['class_id'] : '';
$students = [];

if (!empty($selected_class_id)) {
    // Check if class_id exists
    $check_class = $conn->prepare("SELECT COUNT(*) FROM classes WHERE id = ?");
    $check_class->bind_param("s", $selected_class_id);
    $check_class->execute();
    $check_class_result = $check_class->get_result();
    $class_exists = $check_class_result->fetch_row()[0];

    if ($class_exists) {
        $stmt = $conn->prepare("SELECT 
                                    students.id, 
                                    students.name, 
                                    students.contact_number, 
                                    students.parent_name,
                                    students.aadhar,
                                    classes.name AS class_name
                                FROM students
                                JOIN classes ON students.class_id = classes.id
                                WHERE students.class_id = ?");
        $stmt->bind_param("s", $selected_class_id);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $students = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            die("Error executing the query: " . $stmt->error);
        }
    } else {
        echo "<p style='color: red; text-align: center;'>Invalid class selected.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Students</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
        background: #f5f6f8;
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
        margin: 20px 0;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }

    select {
        padding: 10px;
        border-radius: 6px;
        font-size: 1rem;
        border: 1px solid #ccc;
        min-width: 200px;
    }

    button {
        padding: 10px 20px;
        background-color: #3498db;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    button:hover {
        background-color: #2980b9;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #2c3e50;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    @media (max-width: 600px) {
        form {
            flex-direction: column;
            align-items: center;
        }

        select, button {
            width: 100%;
        }
    }
  </style>
</head>
<body>

<div class="container">
    <h2>View Students by Class</h2>

    <form method="GET">
        <select name="class_id" required>
            <option value="">-- Select Class --</option>
            <?php while ($row = $class_result->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>" <?= $selected_class_id == $row['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($row['name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Search</button>
    </form>

    <?php if (!empty($students)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Contact</th>
                    <th>Parent's Name</th>
                    <th>Aadhar No.</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $stu): ?>
                    <tr>
                        <td><?= $stu['id'] ?></td>
                        <td><?= htmlspecialchars($stu['name']) ?></td>
                        <td><?= htmlspecialchars($stu['class_name']) ?></td>
                        <td><?= htmlspecialchars($stu['contact_number']) ?></td>
                        <td><?= htmlspecialchars($stu['parent_name']) ?></td>
                        <td><?= htmlspecialchars($stu['aadhar']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($selected_class_id): ?>
        <p style="text-align: center; color: #888;">No students found in this class.</p>
    <?php endif; ?>
</div>

</body>
</html>
