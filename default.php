<?php

$mysqli = require __DIR__ . "/database.php";

// Default users to add
$default_users = [
    ["judge1", "secret123", "judge"],
    ["judge2", "secret123", "judge"],
    ["judge3", "secret123", "judge"],
    ["judge4", "secret123", "judge"],
    ["admin", "admin", "admin"]
];

foreach ($default_users as $user) {
    // Hash the password
    $password_hash = password_hash($user[1], PASSWORD_DEFAULT);

    // Use INSERT IGNORE to prevent duplicate entries
    $sql = "INSERT IGNORE INTO users (username, password_hash, role) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $user[0], $password_hash, $user[2]);
    $stmt->execute();
    $stmt->close();
}

echo "Default users added successfully.";

$mysqli->close();

?>
