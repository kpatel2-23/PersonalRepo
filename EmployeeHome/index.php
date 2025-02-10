<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Employee Home</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="employee-home">
    <header>
      <h1>Employee Home Screen</h1>
    </header>

    <!-- Employee Details -->
    <section class="employee-details">
      <?php
        // In a real application, this would come from session or database
        $employeeUsername = "john.doe";
        echo "<p>Welcome, $employeeUsername</p>";
      ?>
    </section>

    <!-- Task List -->
    <section class="task-list">
      <h2>Your Tasks</h2>
      <?php
        // Example tasks array
        $tasks = [
          [
            "name" => "Complete Project Plan",
            "description" => "Draft and finalize the project plan for Q2 deliverables.",
            "dueDate" => "2025-03-15",
            "prerequisites" => ["Outline Requirements"],
            "underResourced" => false,
            "needsTraining" => false
          ],
          [
            "name" => "Outline Requirements",
            "description" => "Gather and list all requirements from stakeholders.",
            "dueDate" => "2025-02-20",
            "prerequisites" => [],
            "underResourced" => true,
            "needsTraining" => false
          ],
          [
            "name" => "Team Meeting",
            "description" => "Attend the weekly team sync meeting.",
            "dueDate" => "2025-02-14",
            "prerequisites" => [],
            "underResourced" => false,
            "needsTraining" => true
          ]
        ];

        // Display each task
        foreach ($tasks as $task) {
          echo "<div class='task-item'>";
          echo "<h3>" . $task['name'] . "</h3>";
          echo "<p class='description'>" . $task['description'] . "</p>";
          echo "<p class='due-date'>Due Date: " . $task['dueDate'] . "</p>";

          if (!empty($task['prerequisites'])) {
            echo "<p class='prereqs'>Prerequisites: " . implode(", ", $task['prerequisites']) . "</p>";
          }

          // Flags for under-resourced or training needs
          echo "<div class='task-flags'>";
          echo "  <label class='flag-label'>";
          echo "    <input type='checkbox' class='flag-checkbox underResourced' " . ($task['underResourced'] ? "checked" : "") . " />";
          echo "    Under-Resourced";
          echo "  </label>";
          echo "  <label class='flag-label'>";
          echo "    <input type='checkbox' class='flag-checkbox needsTraining' " . ($task['needsTraining'] ? "checked" : "") . " />";
          echo "    Needs Training";
          echo "  </label>";
          echo "</div>";

          echo "</div>";
        }
      ?>
    </section>
  </div>
  <!-- Krishna --> 
  <!-- Link to your JavaScript file -->
  <script src="script.js"></script>
</body>
</html>
