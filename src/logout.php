<?php

session_start();

// Clear session variables
session_unset();

// Destroy the session
session_destroy();

// Invalidate the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Validate the host name
$allowed_hosts = ['www.example.com', 'example.com'];
$host = $_SERVER['HTTP_HOST'];
if (!in_array($host, $allowed_hosts)) {
    // Log this attempt or handle as you see fit
    $host = 'www.example.com';  // Default to a safe option
}

// Redirect to login page with absolute URL
$protocol = 'http://';
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    $protocol = 'https://';
}
header("Location: " . $protocol . $host . "/php-login");
exit();