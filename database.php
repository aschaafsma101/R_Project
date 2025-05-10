<?php
$host = "localhost";
$dbname = "aschaaf_db";
$username = "aschaaf_me";
$password = "1Super2001";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
?>
