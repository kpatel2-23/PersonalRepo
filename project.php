<?php
// project.php
include 'db_connect.php';
// Mock project data
$projectName = "Project A";
$tasks = [
  ["id" => 1, "name" => "Task 1", "due_date" => "2025-12-01", "prereq" => null],
  ["id" => 2, "name" => "Task 2", "due_date" => "2025-12-05", "prereq" => 1],
  ["id" => 3, "name" => "Task 3", "due_date" => "2025-11-20", "prereq" => null],
  ["id" => 5, "name" => "Task 5", "due_date" => "2025-12-10", "prereq" => [2,3]],
];
// In reality, you'd filter tasks by the logged-in user, etc.
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title><?php echo $projectName; ?> - Management</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <?php include 'includes/header.php'; ?>

  <div class="project-container">
    <!-- Left side: Task Tree (zoomable/scrollable region) -->
    <div class="task-tree" id="taskTree">
      <h2>Task Dependency Tree</h2>
      <!-- A placeholder area where we might render a network/graph via JS -->
      <!-- For example, you can use a library like D3 or a custom canvas approach -->
      <canvas id="taskTreeCanvas"></canvas>
    </div>

    <!-- Right side: Tasks assigned to the current user -->
    <div class="task-list">
      <h2>Your Tasks</h2>
      <?php foreach ($tasks as $task): ?>
        <div class="task-card">
          <h3><?php echo $task['name']; ?></h3>
          <p>Due Date: <?php echo $task['due_date']; ?></p>
          <!-- Flags (under-resourced, training needed) -->
          <div class="flags">
            <span class="flag under-resourced" onclick="toggleFlag(this)">🏴</span>
            <span class="flag needs-training"   onclick="toggleFlag(this)">🏴</span>
          </div>
          <p>Team Leader: Bob<br>Manager: Alice</p>
          <!-- Minimal "surrounding" tasks snippet for dependency context -->
          <p>Prerequisite: <?php echo $task['prereq'] ? implode(", ", (array)$task['prereq']) : "None"; ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="kanban-link">
    <a href="kanban.php?project_id=1">Go to Kanban Board</a>
  </div>

  <script src="script.js"></script>
</body>
</html>
