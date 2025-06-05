<?php
$conn = new mysqli("localhost", "root", "", "school_db");

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['confirm'])) {
        $error = "⚠️ Please confirm the details before submitting.<br>कृपया पुष्टि करें कि दर्ज की गई जानकारी सही है।";
    } else {
        $student_name     = $_POST['student_name'];
        $gender           = $_POST['gender'];
        $dob              = $_POST['dob'];
        $aadhar           = $_POST['aadhar'];
        $parent_name      = $_POST['parent_name'];
        $contact_number   = $_POST['contact_number'];
        $address          = $_POST['address'];
        $previous_school  = $_POST['previous_school'];
        $previous_class   = $_POST['previous_class'];

        $stmt = $conn->prepare("INSERT INTO admission (student_name, gender, dob, aadhar, parent_name, contact_number, address, previous_school, previous_class)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $student_name, $gender, $dob, $aadhar, $parent_name, $contact_number, $address, $previous_school, $previous_class);
        $stmt->execute();

        $success = "✅ Admission form submitted successfully!<br>प्रवेश फॉर्म सफलतापूर्वक जमा किया गया है!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aryavart Academy - Admission Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #e0f7fa, #f1f8e9);
            font-family: 'Poppins', sans-serif;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 30px 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .logo {
            height: 70px;
            margin-bottom: 10px;
        }

        .form-card {
            max-width: 750px;
            margin: 40px auto;
            background-color: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-floating > label {
            font-size: 14px;
        }

        .form-check-label {
            font-size: 15px;
        }

        .alert {
            font-size: 15px;
        }

        .btn-primary {
            font-size: 16px;
            padding: 12px;
            font-weight: 600;
        }

        h2, h5 {
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- School Header -->
    <div class="header">
        <!-- <img src="logo.png" alt="School Logo" class="logo"> -->
        <h2>Aryavart Academy School</h2>
        <h5>Student Admission Form</h5>
    </div>

    <!-- Admission Form Card -->
    <div class="form-card">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="student_name" name="student_name" required>
                <label for="student_name">Student Name</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" id="gender" name="gender" required>
                    <option value="" selected disabled>Select</option>
                    <option value="Male">Male / पुरुष</option>
                    <option value="Female">Female / महिला</option>
                    <option value="Other">Other / अन्य</option>
                </select>
                <label for="gender">Gender</label>
            </div>

            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="dob" name="dob" required>
                <label for="dob">Date of Birth</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="aadhar" name="aadhar" maxlength="12">
                <label for="aadhar">Aadhar Number (optional)</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="parent_name" name="parent_name" required>
                <label for="parent_name">Parent's Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="contact_number" name="contact_number" required>
                <label for="contact_number">Contact Number</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Enter address" id="address" name="address" style="height: 100px;" required></textarea>
                <label for="address">Address</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="previous_school" name="previous_school" required>
                <label for="previous_school">Previous School</label>
            </div>

            <div class="form-floating mb-4">
                <input type="text" class="form-control" id="previous_class" name="previous_class" required>
                <label for="previous_class">Previous Class</label>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="confirm" id="confirm" required>
                <label class="form-check-label" for="confirm">
                    I confirm that the information provided is correct. <br>
                    मैं पुष्टि करता/करती हूँ कि ऊपर दी गई जानकारी सही है।
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit Admission</button>
        </form>
    </div>

</body>
</html>
