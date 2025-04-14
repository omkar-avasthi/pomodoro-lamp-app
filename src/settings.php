<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/settings.js"></script>
</head>
<body class="container mt-5">
    <h1>Pomodoro Settings</h1>

    <form id="settingsForm">
        <div class="mb-3">
            <label>Work Duration (minutes):</label>
            <input type="number" id="workDuration" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Short Break Duration (minutes):</label>
            <input type="number" id="shortBreak" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Long Break Duration (minutes):</label>
            <input type="number" id="longBreak" class="form-control" required>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" id="autoStart" class="form-check-input">
            <label class="form-check-label">Auto-Start Next Session</label>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" id="soundOn" class="form-check-input">
            <label class="form-check-label">Enable Sound Notifications</label>
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>

    <a href="index.php" class="btn btn-secondary mt-3">Back to Timer</a>
</body>
</html>
