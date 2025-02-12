<?php 
// index.php
include 'db_connect.php';
// For demonstration, pretend these are fetched from the DB
$employeeName = "John Doe";
$recentActivities = [
  "Task #14 completed by Sarah",
  "You were assigned Task #22",
  "Team Leader updated Project Beta timeline"
];

// Example analytics
$tasksCompleted = 12;
$tasksOverdue = 1;
$percentageComplete = 75;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Employee Home</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <?php include 'includes/header.php'; // optional common header/nav ?>

  <div class="home-container">
    <!-- Left Navigation Bar -->
    <aside class="nav-bar">
      <h3>Projects</h3>
      <ul>
        <li>
          <strong>Project A</strong><br>
          Manager: Alice<br>
          Team Leader: Bob<br>
          <a href="project.php?project_id=1">Go to Project</a>
        </li>
        <li>
          <strong>Project B</strong><br>
          Manager: Carol<br>
          Team Leader: David<br>
          <a href="project.php?project_id=2">Go to Project</a>
        </li>
        <!-- Repeat as needed -->
      </ul>
    </aside>

    <!-- Main Content -->
    <section class="main-content">
      <h2>Welcome, <?php echo $employeeName; ?></h2>

      <!-- Recent Activity -->
      <div class="recent-activity">
        <h3>Recent Activity</h3>
        <ul>
          <?php foreach ($recentActivities as $activity): ?>
            <li><?php echo $activity; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Basic Analytics -->
      <div class="employee-analytics">
        <h3>Your Analytics</h3>
        <ul>
          <li>Tasks Completed: <?php echo $tasksCompleted; ?></li>
          <li>Tasks Overdue: <?php echo $tasksOverdue; ?></li>
          <li>Overall Completion: <?php echo $percentageComplete; ?>%</li>
          <!-- Add other useful stats as needed -->
        </ul>
      </div>

      <!-- Perhaps a link to the Kanban Board that lists all projects/employees -->
      <div>
        <a href="kanban.php">View Kanban Board</a>
      </div>

    </section>
  </div>
  <script src="script.js"></script>
</body>
</html>
