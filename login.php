<?php

session_start();

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/database.php";

    // Sanitize username to prevent SQL injection
    $username = $mysqli->real_escape_string($_POST["username"]);

    // Fetch user from the database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    if ($user) {
        // Verify password
        if (password_verify($_POST["password"], $user["password_hash"])) {
            // Regenerate session ID for security
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["role"] = $user["role"];

            // Redirect based on role
            if ($user["role"] === "admin") {
                header("Location: admin.php");
            } else {
                header("Location: grading_form.php");
            }
            exit;
        }
    }

    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if ($is_invalid): ?>
        <em>Invalid login. Please try again.</em>
    <?php endif; ?>

    <form method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button>Log in</button>
    </form>

</body>
</html>
