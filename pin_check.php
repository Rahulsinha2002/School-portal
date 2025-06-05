<?php
include '../includes/config.php'; // adjust path

// Set your admin username and password here
$username = "admin";          // your desired username
$plainPassword = "YourPass123";  // your desired password

// Hash the password securely
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

// Prepare SQL to insert or update admin user
// If the user exists, update password; else insert new
$stmt = $conn->prepare("SELECT id FROM admins WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// if ($result->num_rows > 0) {
//     // User exists, update password
//     $stmt = $conn->prepare("UPDATE admins SET password = ? WHERE username = ?");
//     $stmt->bind_param("ss", $hashedPassword, $username);
//     $stmt->execute();
//     // echo "Password updated for user '$username'.";
// } else {
//     // Insert new user
//     $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
//     $stmt->bind_param("ss", $username, $hashedPassword);
//     $stmt->execute();
//     echo "Admin user '$username' created.";
// }
