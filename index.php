<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    // If the user is not logged in, send them to the login page
    header("Location: login.php");
    exit;
}

// Redirect based on the role
if ($_SESSION["role"] === "admin") {
    header("Location: admin.php");
    exit;
} else {
    header("Location: grading_form.php");
    exit;
}

?>
