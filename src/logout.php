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

// Validate the host name, would need to be defined in a real hosted php app on the web 
$allowed_hosts = ['www.example.com', 'example.com', 'localhost', '127.0.0.1'];
$host = $_SERVER['HTTP_HOST'];
if (!in_array($host, $allowed_hosts)) {
    $host = 'localhost';  // Default to a option while we just got the website locally
}

// Redirect to login page with absolute URL
$protocol = 'http://';
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    $protocol = 'https://';
}
header("Location: " . $protocol . $host . "/php-login");
exit();