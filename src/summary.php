<?php
require 'inc/db.php';
$result = $mysqli->query("SELECT session_name, session_time FROM sessions ORDER BY session_time DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Summary</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1>Pomodoro Sessions</h1>
    <table class="table">
        <tr><th>Session Name</th><th>Time</th></tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['session_name']) ?></td>
                <td><?= $row['session_time'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="index.php" class="btn btn-primary">Back to Timer</a>
</body>
</html>

