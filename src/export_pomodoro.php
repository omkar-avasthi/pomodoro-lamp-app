<?php
require 'inc/db.php';

// Set headers to trigger download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=pomodoro_sessions.csv');

// Open output stream
$output = fopen('php://output', 'w');

// Add CSV headers
fputcsv($output, ['Session Name', 'Logged Time']);

// Fetch pomodoro sessions
$result = $mysqli->query("SELECT session_name, session_time FROM sessions ORDER BY session_time DESC");

while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['session_name'],
        $row['session_time']
    ]);
}

fclose($output);
exit;
?>

