<?php

include '../includes/admin_navbar.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #3498db;
            --light-bg: #f5f7fa;
            --card-bg: #ffffff;
            --text-color: #333;
            --shadow: 0 4px 12px rgba(0,0,0,0.1);
            --hover-color: #2980b9;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: var(--light-bg);
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .dashboard-header h1 {
            color: var(--primary-color);
            font-size: 2.5rem;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 2 columns for large screens */
            gap: 30px;
        }

        .dashboard-card {
            display: flex;
            flex-direction: row;
            background: var(--card-bg);
            border-radius: 10px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
        }

        .card-icon {
            width: 140px;
            min-height: 140px;
            background: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            flex-shrink: 0;
        }

        .card-content {
            flex: 1;
            padding: 20px;
        }

        .card-content h3 {
            margin: 0 0 10px;
            color: var(--primary-color);
        }

        .card-content p {
            margin: 0 0 15px;
            color: var(--text-color);
        }

        .card-content a {
            display: inline-block;
            text-decoration: none;
            padding: 10px 16px;
            background: var(--accent-color);
            color: white;
            border-radius: 5px;
        }

        .card-content a:hover {
            background: var(--hover-color);
        }

        @media (max-width: 768px) {
            .card-grid {
                grid-template-columns: 1fr 1fr; /* 2 columns for medium screens */
            }

            .dashboard-card {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .card-icon {
                width: 100%;
                height: 100px;
                border-bottom: 3px solid #fff;
            }
        }

        @media (max-width: 480px) {
            .card-grid {
                grid-template-columns: 1fr; /* 1 column for small screens */
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
        </div>

        <div class="card-grid">
            <div class="dashboard-card">
                <div class="card-icon">🎓</div>
                <div class="card-content">
                    <h3>Student Admission</h3>
                    <p>Manage student admission forms and applications.</p>
                    <a href="../admin/admission.php">Go</a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">🏅</div>
                <div class="card-content">
                    <h3>Awards</h3>
                    <p>Add, update and showcase student award achievements.</p>
                    <a href="../Awards/adminaward.php">Manage</a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">👩‍🏫</div>
                <div class="card-content">
                    <h3>Teachers</h3>
                    <p>View or manage teachers and their subjects.</p>
                    <a href="../teacher/teacher_list.php">View</a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">📝</div>
                <div class="card-content">
                    <h3>Homework</h3>
                    <p>Assign or review student homework and assignments.</p>
                    <a href="../homework/view_homework.php">Check</a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">👨‍🎓</div>
                <div class="card-content">
                    <h3>Students</h3>
                    <p>View student details, attendance, and records.</p>
                    <a href="../admin/view_students.php">Browse</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
