<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "school_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle admin login via PIN stored in database
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['access_code']) && !isset($_SESSION['authenticated'])) {
    $pin = $_POST['access_code'];
    $stmt = $conn->prepare("SELECT id FROM adminspin WHERE pin = ?");
    $stmt->bind_param("s", $pin);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['authenticated'] = true;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $error = "Incorrect PIN.";
    }
}

// If not authenticated, show login form
if (!isset($_SESSION['authenticated'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Login - Enter PIN</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body { display: flex; height: 100vh; align-items: center; justify-content: center; background: #f4f4f4; }
            .login-box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); width: 100%; max-width: 360px; }
        </style>
    </head>
    <body>
    <div class="login-box">
        <h4 class="mb-3 text-center">Admin PIN</h4>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="password" name="access_code" class="form-control mb-3" placeholder="Enter PIN" required>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
    </body>
    </html>
    <?php
    exit();
}

// Below this line only runs when authenticated

// Handle deletion
if (isset($_POST['delete'])) {
    $id = (int)$_POST['delete_id'];
    $conn->query("DELETE FROM admission WHERE id = $id");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle status update (Admit/Cancel)
if (isset($_POST['update_status'])) {
    $id     = (int)$_POST['status_id'];
    $status = $conn->real_escape_string($_POST['status']);
    $class  = $conn->real_escape_string($_POST['class']);

    // Update admission record
    $conn->query("UPDATE admission SET status='$status', class='$class' WHERE id=$id");

    if ($status === 'Admit') {
        // Fetch admission data
        $row = $conn->query("SELECT * FROM admission WHERE id = $id")->fetch_assoc();
        
        // Insert into students table
        $stmt2 = $conn->prepare(
            "INSERT INTO students (name, class_id, gender, dob, aadhar, parent_name, contact_number, address, created_at)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())"
        );
        $stmt2->bind_param(
            "ssssssss",
            $row['student_name'],
            $row['class'],
            $row['gender'],
            $row['dob'],
            $row['aadhar'],
            $row['parent_name'],
            $row['contact_number'],
            $row['address']
        );
        $stmt2->execute();

        // After successful insert, delete from admission table
        $conn->query("DELETE FROM admission WHERE id = $id");

        // Redirect to refresh the page and clear any POST data
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif ($status === 'Cancel') {
        // Remove from admission
        $conn->query("DELETE FROM admission WHERE id = $id");
        // Redirect to refresh the page and clear any POST data
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Fetch all admissions
$result = $conn->query("SELECT * FROM admission ORDER BY created_at DESC");

// Fetch all classes for the dropdown
$classes_result = $conn->query("SELECT id, name FROM classes ORDER BY sort_order ASC");

$classes = [];
while ($row = $classes_result->fetch_assoc()) {
    $classes[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Student Admissions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .container { margin-top: 40px; }
        th { background: #007bff; color: white; }
        .table-responsive { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4">Student Admissions</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>ID</th><th>Name</th><th>Gender</th><th>DOB</th><th>Aadhar</th>
                <th>Parent</th><th>Contact</th><th>Prev School</th><th>Prev Class</th>
                <th>Class</th><th>Status</th><th>Submitted</th><th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['student_name']) ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= $row['dob'] ?></td>
                    <td><?= $row['aadhar'] ?></td>
                    <td><?= htmlspecialchars($row['parent_name']) ?></td>
                    <td><?= $row['contact_number'] ?></td>
                    <td><?= htmlspecialchars($row['previous_school']) ?></td>
                    <td><?= $row['previous_class'] ?></td>
                    <td><?= $row['class'] ?></td>
                    <td>
                        <form method="POST" class="d-flex">
                            <select name="status" class="form-select form-select-sm me-2">
                                <option value="Admit" <?= $row['status'] === 'Admit' ? 'selected' : '' ?>>Admit</option>
                                <option value="Cancel" <?= $row['status'] === 'Cancel' ? 'selected' : '' ?>>Cancel</option>
                            </select>
                            <select name="class" class="form-select form-select-sm me-2">
                                <?php foreach ($classes as $class): ?>
                                    <option value="<?= $class['id'] ?>" <?= $row['class'] === $class['id'] ? 'selected' : '' ?>><?= $class['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="status_id" value="<?= $row['id'] ?>">
                            <button type="submit" name="update_status" class="btn btn-primary btn-sm">Go</button>
                        </form>
                    </td>
                    <td><?= $row['created_at'] ?></td>
                    <td>
                        <form method="POST" onsubmit="return confirm('Delete this admission?');">
                            <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
