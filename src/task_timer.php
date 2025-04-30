<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Task Timer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    .timer {
      font-size: 3rem;
      font-weight: bold;
    }
  </style>
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
    <a href="index.php" class="btn btn-outline-secondary">Pomodoro</a>
    <a href="task_timer.php" class="btn btn-outline-primary active">Task Timer</a>
  </div>
</div>

<!-- Task Timer Interface -->
<div class="container text-center mt-5">
  <h1>Task Timer</h1>

  <input type="text" id="taskName" class="form-control mb-3" placeholder="Enter task name" required>

  <div class="timer" id="taskTimer">00:00:00</div>

  <div class="mt-3">
    <button class="btn btn-success me-2" onclick="startTask()">Start</button>
    <button class="btn btn-danger me-2" onclick="stopTask()">Stop</button>
    <button class="btn btn-secondary" onclick="resetTimer()">Reset</button>
  </div>

  <div class="mt-4">
    <a href="task_summary.php" class="btn btn-info">View Task Report</a>
    <a href="export_report.php" class="btn btn-outline-primary">Export CSV</a>
    <a href="index.php" class="btn btn-outline-secondary">← Back to Home</a>
  </div>
</div>

<script>
let interval = null;
let startTimestamp = null;
let elapsedSeconds = 0;

function formatTime(seconds) {
  const h = String(Math.floor(seconds / 3600)).padStart(2, '0');
  const m = String(Math.floor((seconds % 3600) / 60)).padStart(2, '0');
  const s = String(seconds % 60).padStart(2, '0');
  return `${h}:${m}:${s}`;
}

function updateDisplay() {
  if (!startTimestamp) {
    document.getElementById("taskTimer").innerText = "00:00:00";
    return;
  }
  const now = Date.now();
  elapsedSeconds = Math.floor((now - startTimestamp) / 1000);
  document.getElementById("taskTimer").innerText = formatTime(elapsedSeconds);
}

function startTask() {
  if (interval) return;

  const taskName = document.getElementById("taskName").value.trim();
  if (!taskName) {
    alert("Please enter a task name before starting the timer.");
    return;
  }

  startTimestamp = Date.now();
  updateDisplay();
  interval = setInterval(updateDisplay, 1000);
}

function stopTask() {
  if (!interval) return;

  clearInterval(interval);
  interval = null;

  const taskName = document.getElementById("taskName").value.trim();
  if (!taskName) {
    alert("Please enter a task name.");
    return;
  }

  const startISO = new Date(startTimestamp).toISOString();
  const endISO = new Date().toISOString();

  fetch('log_task.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `taskName=${encodeURIComponent(taskName)}&startTime=${startISO}&endTime=${endISO}&duration=${elapsedSeconds}`
  }).then(res => res.text())
    .then(msg => {
      alert("Task logged!");
      resetTimer();
    })
    .catch(err => console.error(err));
}

function resetTimer() {
  clearInterval(interval);
  interval = null;
  startTimestamp = null;
  elapsedSeconds = 0;
  updateDisplay();
}

updateDisplay();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

