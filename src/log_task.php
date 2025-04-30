<?php
require 'inc/db.php';

$taskName = $_POST['taskName'] ?? 'Unnamed Task';
$startTime = $_POST['startTime'] ?? '';
$endTime = $_POST['endTime'] ?? '';
$duration = (int) ($_POST['duration'] ?? 0);

// Convert ISO 8601 to MySQL DATETIME
function formatDatetime($isoString) {
    // Example: 2025-04-29T06:56:39.443Z --> 2025-04-29 06:56:39
    $dateTime = date('Y-m-d H:i:s', strtotime($isoString));
    return $dateTime;
}

$startTimeFormatted = formatDatetime($startTime);
$endTimeFormatted = formatDatetime($endTime);

$taskName = $mysqli->real_escape_string($taskName);
$startTimeFormatted = $mysqli->real_escape_string($startTimeFormatted);
$endTimeFormatted = $mysqli->real_escape_string($endTimeFormatted);

$query = "INSERT INTO task_sessions (task_name, start_time, end_time, duration)
          VALUES ('$taskName', '$startTimeFormatted', '$endTimeFormatted', $duration)";

if ($mysqli->query($query)) {
    echo "Success";
} else {
    echo "Error inserting: " . $mysqli->error;
}
?>

