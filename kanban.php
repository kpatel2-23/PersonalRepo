<?php
// kanban.php
// Example tasks for the entire project
$projectTasks = [
  ["employee" => "John Doe",  "task" => "Task 1", "status" => "In Progress"],
  ["employee" => "John Doe",  "task" => "Task 2", "status" => "Completed"],
  ["employee" => "Sarah Lee", "task" => "Task 3", "status" => "Overdue"],
  ["employee" => "Sarah Lee", "task" => "Task 4", "status" => "To Assign"]
];

// A quick grouping approach (in real code, you'd do this in SQL or PHP logic)
$employees = [];
foreach ($projectTasks as $pt) {
  $employees[$pt["employee"]][] = ["task"=>$pt["task"], "status"=>$pt["status"]];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kanban Board</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'includes/header.php'; ?>

  <h1>Kanban Board</h1>
  <table class="kanban-table">
    <thead>
      <tr>
        <th>Employee</th>
        <th>To Be Assigned</th>
        <th>In Progress</th>
        <th>Completed</th>
        <th>Overdue</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($employees as $empName => $taskList): ?>
        <tr>
          <td><?php echo $empName; ?></td>
          <td>
            <?php
              foreach ($taskList as $t) {
                if ($t["status"] === "To Assign") {
                  echo "<div class='task-card'>$t[task]</div>";
                }
              }
            ?>
          </td>
          <td>
            <?php
              foreach ($taskList as $t) {
                if ($t["status"] === "In Progress") {
                  echo "<div class='task-card'>$t[task]</div>";
                }
              }
            ?>
          </td>
          <td>
            <?php
              foreach ($taskList as $t) {
                if ($t["status"] === "Completed") {
                  echo "<div class='task-card'>$t[task]</div>";
                }
              }
            ?>
          </td>
          <td>
            <?php
              foreach ($taskList as $t) {
                if ($t["status"] === "Overdue") {
                  echo "<div class='task-card'>$t[task]</div>";
                }
              }
            ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <script src="script.js"></script>
</body>
</html>
