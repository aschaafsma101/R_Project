
<?php
session_start();
if (!isset($_SESSION['loggedin']) || ($_SESSION['username'] !== 'judge1' && $_SESSION['username'] !== 'judge2')) {
    header("Location: login.html");
    exit();
}
?>

<h2>Welcome, <?php echo $_SESSION['username']; ?>! Submit your evaluation:</h2>
<form action="submit.php" method="POST">
    Score: <input type="number" name="score" required><br><br>
    Comments:<br>
    <textarea name="comments" rows="5" cols="40" required></textarea><br><br>
    <input type="submit" value="Submit">
</form>

<a href="logout.php">Logout</a>
