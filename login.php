
<?php
session_start();

$users = [
    "judge1" => "secret123",
    "judge2" => "secret123",
    "admin"  => "adminpass"
];

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (array_key_exists($username, $users) && $users[$username] === $password) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;

    if ($username === "admin") {
        header("Location: admin.php");
    } else {
        header("Location: judge.php");
    }
    exit();
} else {
    echo "Invalid username or password.";
}
?>
