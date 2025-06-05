<?php
session_start();
include '../includes/config.php';
include '../includes/admin_navbar.html';

$class_id = $_GET['class_id'] ?? '';
$from_date = $_GET['from_date'] ?? '';
$to_date = $_GET['to_date'] ?? '';
$records = [];

// Fetch all classes for dropdown
$class_result = $conn->query("SELECT * FROM classes ORDER BY name ASC");

// Fetch attendance records if a class is selected
if (!empty($class_id)) {
    // Build base SQL query
    $sql = "SELECT s.name AS student_name, a.attendance_status, a.date
            FROM attendance a
            INNER JOIN students s ON a.student_id = s.id
            WHERE s.class_id = ?";

    $params = [$class_id];
    $types = "i";

    // Add optional date range
    if (!empty($from_date) && !empty($to_date)) {
        $sql .= " AND a.date BETWEEN ? AND ?";
        $params[] = $from_date;
        $params[] = $to_date;
        $types .= "ss";
    }

    $sql .= " ORDER BY a.date ASC";

    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    $records = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>📋 View Attendance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 0; background: #f0f2f5; }
        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        form.filters {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }
        select, input[type="date"], button {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #34495e;
            color: white;
        }
        .status-present { color: green; font-weight: bold; }
        .status-absent { color: red; font-weight: bold; }
        .status-late { color: orange; font-weight: bold; }

        @media (max-width: 768px) {
            table { font-size: 14px; }
            form.filters { flex-direction: column; align-items: center; }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>📅 View Attendance - Class-wise</h2>

    <form method="GET" class="filters">
        <select name="class_id" required>
            <option value="">-- Select Class --</option>
            <?php while ($row = $class_result->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>" <?= $class_id == $row['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($row['name']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <input type="date" name="from_date" value="<?= $from_date ?>">
        <input type="date" name="to_date" value="<?= $to_date ?>">
        <button type="submit">Filter</button>
    </form>

    <?php if (!empty($records)): ?>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Student Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $rec): ?>
                    <tr>
                        <td><?= htmlspecialchars($rec['date']) ?></td>
                        <td><?= htmlspecialchars($rec['student_name']) ?></td>
                        <td class="status-<?= strtolower($rec['attendance_status']) ?>">
                            <?= ucfirst($rec['attendance_status']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($class_id): ?>
        <p style="text-align: center; color: #888;">No attendance records found for this class/date range.</p>
    <?php endif; ?>
</div>
</body>
</html>
