<?php
require 'inc/db.php';

$filter = $_GET['filter'] ?? 'all';
$whereClause = "";

switch ($filter) {
    case 'today':
        $whereClause = "WHERE DATE(start_time) = CURDATE()";
        break;
    case 'week':
        $whereClause = "WHERE YEARWEEK(start_time, 1) = YEARWEEK(CURDATE(), 1)";
        break;
    case 'month':
        $whereClause = "WHERE MONTH(start_time) = MONTH(CURDATE()) AND YEAR(start_time) = YEAR(CURDATE())";
        break;
    case 'year':
        $whereClause = "WHERE YEAR(start_time) = YEAR(CURDATE())";
        break;
    default:
        $whereClause = "";
}

$query = "SELECT task_name, SUM(duration) as total_seconds FROM task_sessions $whereClause GROUP BY task_name ORDER BY total_seconds DESC";
$result = $mysqli->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Task Summary</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="container mt-5">

  <h1>Task Summary</h1>

  <!-- Filters -->
  <form method="GET" class="mb-4">
    <div class="btn-group" role="group">
      <a href="?filter=all" class="btn btn-outline-primary <?= $filter === 'all' ? 'active' : '' ?>">All</a>
      <a href="?filter=today" class="btn btn-outline-primary <?= $filter === 'today' ? 'active' : '' ?>">Today</a>
      <a href="?filter=week" class="btn btn-outline-primary <?= $filter === 'week' ? 'active' : '' ?>">This Week</a>
      <a href="?filter=month" class="btn btn-outline-primary <?= $filter === 'month' ? 'active' : '' ?>">This Month</a>
      <a href="?filter=year" class="btn btn-outline-primary <?= $filter === 'year' ? 'active' : '' ?>">This Year</a>
    </div>
  </form>

  <!-- Table -->
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Task Name</th>
        <th>Total Time</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $taskLabels = [];
      $taskDurations = [];

      while ($row = $result->fetch_assoc()):
        $taskLabels[] = $row['task_name'];
        $taskDurations[] = round($row['total_seconds'] / 60, 2); // convert to minutes
        ?>
        <tr>
          <td><?= htmlspecialchars($row['task_name']) ?></td>
          <td><?= gmdate("H:i:s", $row['total_seconds']) ?> (<?= round($row['total_seconds'] / 60, 2) ?> mins)</td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <!-- Chart -->
  <div class="mt-5">
    <canvas id="taskChart"></canvas>
  </div>

  <!-- Back -->
  <a href="task_timer.php" class="btn btn-secondary mt-4">← Back to Timer</a>

  <script>
    const ctx = document.getElementById('taskChart');
    const chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?= json_encode($taskLabels) ?>,
        datasets: [{
          label: 'Time Spent (minutes)',
          data: <?= json_encode($taskDurations) ?>,
          backgroundColor: 'rgba(54, 162, 235, 0.5)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          title: { display: true, text: 'Time Spent per Task' }
        },
        scales: {
          y: {
            beginAtZero: true,
            title: { display: true, text: 'Minutes' }
          }
        }
      }
    });
  </script>
</body>
</html>

