
<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.html");
    exit();
}

echo "<h2>Admin Panel – All Judge Submissions</h2>";

if (file_exists("data.txt")) {
    $lines = file("data.txt", FILE_IGNORE_NEW_LINES);
    echo "<table border='1' cellpadding='5'><tr><th>Judge</th><th>Score</th><th>Comments</th><th>Timestamp</th></tr>";
    foreach ($lines as $line) {
        $parts = explode(" | ", $line);
        echo "<tr><td>".htmlspecialchars($parts[0])."</td><td>".htmlspecialchars($parts[1])."</td><td>".htmlspecialchars($parts[2])."</td><td>".htmlspecialchars($parts[3])."</td></tr>";
    }
    echo "</table>";
} else {
    echo "No submissions yet.";
}
?>

<a href="logout.php">Logout</a>
