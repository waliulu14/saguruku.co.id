<?php
// Start the PHP session at the beginning of the file
session_start();

// Destroy the session to log out the user
session_destroy();

// Redirect the user to the login page after logging out
header("Location: login/index.php");
exit;
?>
