<?php
require 'inc/db.php';

// Set headers to trigger file download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=task_report.csv');

// Open output stream
$output = fopen('php://output', 'w');

// Add CSV column headings
fputcsv($output, ['Task Name', 'Start Time', 'End Time', 'Duration (seconds)', 'Duration (formatted)']);

// Fetch tasks
$result = $mysqli->query("SELECT task_name, start_time, end_time, duration FROM task_sessions ORDER BY start_time DESC");

while ($row = $result->fetch_assoc()) {
    // Format duration nicely (HH:MM:SS)
    $formattedDuration = gmdate("H:i:s", $row['duration']);
    fputcsv($output, [
        $row['task_name'],
        $row['start_time'],
        $row['end_time'],
        $row['duration'],
        $formattedDuration
    ]);
}

fclose($output);
exit;
?>

