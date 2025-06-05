<?php
session_start();
include '../includes/config.php';
include '../includes/admin_navbar.html'; // Navbar if needed

$message = "";

if (isset($_POST['submit'])) {
    // Get form values
    $name = $_POST['name'];
    $class_id = $_POST['class_id'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $aadhar = $_POST['aadhar'];
    $parent_name = $_POST['parent_name'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $created_at = date("Y-m-d H:i:s");

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO students (name, class_id, gender, dob, aadhar, parent_name, contact_number, address, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $name, $class_id, $gender, $dob, $aadhar, $parent_name, $contact_number, $address, $created_at);

    if ($stmt->execute()) {
        $message = "✅ Student added successfully!";
    } else {
        $message = "❌ Failed to add student: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f0f2f5;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
        }

        button:hover {
            background-color: #2980b9;
        }

        .message {
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add New Student</h2>

    <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>

    <form method="POST" action="">
        <label for="name">Student Name</label>
        <input type="text" id="name" name="name" required>

        <label for="class_id">Select Class</label>
        <select id="class_id" name="class_id" required>
            <option value="">-- Select Class --</option>
            <?php
            $classQuery = $conn->query("SELECT * FROM classes ORDER BY sort_order ASC");
            while ($row = $classQuery->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
            }
            ?>
        </select>

        <label for="gender">Gender</label>
        <select id="gender" name="gender" required>
            <option value="">-- Select Gender --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label for="dob">Date of Birth</label>
        <input type="date" id="dob" name="dob" required>

        <label for="aadhar">Aadhar Number</label>
        <input type="text" id="aadhar" name="aadhar" required>

        <label for="parent_name">Parent Name</label>
        <input type="text" id="parent_name" name="parent_name" required>

        <label for="contact_number">Contact Number</label>
        <input type="text" id="contact_number" name="contact_number" required>

        <label for="address">Address</label>
        <input type="text" id="address" name="address" required>

        <button type="submit" name="submit">Add Student</button>
    </form>
</div>

</body>
</html>
