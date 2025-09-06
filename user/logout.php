<?php
session_start(); // Start the session

// Remove all session variables
session_unset();

// Destroy the session completely
session_destroy();

// Redirect to homepage (or login page)
header("Location: dashboard.php");
exit;
?>
