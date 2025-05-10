<?php

session_start();

// Destroy the current session
session_unset();
session_destroy();

// Redirect to the login page
header("Location: login.php");
exit;

?>
