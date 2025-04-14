<?php
$mysqli = new mysqli("db", "root", "root", "pomodoro_db");
if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}
?>

