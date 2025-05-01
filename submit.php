
<?php
session_start();
if (!isset($_SESSION['loggedin']) || ($_SESSION['username'] !== 'judge1' && $_SESSION['username'] !== 'judge2')) {
    header("Location: login.html");
    exit();
}

$score = $_POST['score'] ?? '';
$comments = $_POST['comments'] ?? '';
$judge = $_SESSION['username'];

if ($score && $comments) {
    $line = "$judge | $score | " . str_replace(["\r", "\n"], ' ', $comments) . " | " . date("Y-m-d H:i:s") . "\n";
    file_put_contents("data.txt", $line, FILE_APPEND);
    echo "Submission saved. <a href='judge.php'>Back</a>";
} else {
    echo "Missing data.";
}
?>
