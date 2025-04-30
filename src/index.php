<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pomodoro App</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Pomodoro App</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="settings.php">Settings</a></li>
        <li class="nav-item"><a class="nav-link" href="summary.php">Pomodoro Report</a></li>
        <li class="nav-item"><a class="nav-link" href="task_summary.php">Task Report</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Mode Selector -->
<div class="container mt-4 text-center">
  <div class="btn-group" role="group" aria-label="Mode Selection">
    <a href="index.php" class="btn btn-outline-primary active">Pomodoro</a>
    <a href="task_timer.php" class="btn btn-outline-secondary">Task Timer</a>
  </div>
</div>

<!-- Pomodoro Timer Interface -->
<div class="container text-center mt-5">
  <h1>Pomodoro Timer</h1>
  <input type="text" id="sessionName" class="form-control mb-3" placeholder="Session Name">
  <div class="timer display-1" id="timer">25:00</div>
  <div class="mt-3">
    <button class="btn btn-success me-2" onclick="startTimer()">Start</button>
    <button class="btn btn-danger me-2" onclick="resetTimer()">Reset</button>
  </div>
  <h4 class="mt-3" id="status">Ready</h4>
</div>

<script src="assets/js/timer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

