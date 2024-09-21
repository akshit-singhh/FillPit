<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header("Location: http://localhost:8080/fillpit/login/adminlogin/admin.php");
exit;
?>
