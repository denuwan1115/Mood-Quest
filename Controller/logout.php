<?php
// Start the session if it hasn't been started already
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include configuration file if needed
include_once 'config.php';

// Unset all session variables
$_SESSION = array();

// If you're using a session cookie, destroy it
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Set a logout message (optional)
$_SESSION['message'] = "You have been successfully logged out.";

// Redirect to login page
header("Location: ../View/login.php");
exit();
?>