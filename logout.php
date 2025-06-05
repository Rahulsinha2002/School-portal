<?php
// logout.php

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => true, // Use true if HTTPS
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();

// Unset all session variables
session_unset();

// Destroy session and cookies
session_destroy();

// Clear the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect to login
header("Location: login.php");
exit();
