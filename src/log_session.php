<?php
require 'inc/db.php';
$name = $mysqli->real_escape_string($_POST['name'] ?? 'Unnamed');
$mysqli->query("INSERT INTO sessions (session_name) VALUES ('$name')");
?>

