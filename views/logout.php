<?php
// Start or resume session
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy session cookie if exists
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]
    );
}

// Finally destroy the session
session_destroy();

// Optional: Clear authentication cookies if used
setcookie("rememberme", "", time() - 3600, "/");

// Redirect to login page or home page
header("Location: ./login.php");
exit;
?>
