<?php
// start session for authentication
session_start();

// dummy session assignment for demonstration
// in a real app, assign these during login and use proper authentication
if (!isset($_SESSION['role'])) {
    // change to 'manager' to test manager view; default is 'employee'
    $_SESSION['role'] = 'employee';
}

// determine which page to show; default is employee view
$page = isset($_GET['page']) ? $_GET['page'] : 'employee';

// if user is not a manager but is trying to access the manager page, redirect
if ($page === 'manager' && $_SESSION['role'] !== 'manager') {
    header('Location: index.php');
    exit();
}

// process form submission on the manager page
if ($page === 'manager' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // get and trim posted form data
    $taskName = trim($_POST['task_name']);
    $dueDate = $_POST['due_date'];
    $priority = (int) $_POST['priority'];
    $prerequisites = trim($_POST['prerequisites']);
    $flagUnderResourced = isset($_POST['flag_under_resourced']) ? 1 : 0;
    $flagRequiresTraining = isset($_POST['flag_requires_training']) ? 1 : 0;
    
    // in a real application, validate, sanitize, and then save the task to a database
    
    // for demonstration, set a success message
    $message = "task created successfully.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($page === 'manager') ? 'manager - create task' : 'employee - home'; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="container">
        <h1><?php echo ($page === 'manager') ? 'create task' : 'employee home'; ?></h1>
    </header>
    <div class="container">
    <?php if ($page === 'manager'): ?>
        <?php if (isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <!-- form for managers to create a task -->
        <form method="POST" action="index.php?page=manager">
            <!-- task name -->
            <label for="task_name">task name:</label>
            <input type="text" id="task_name" name="task_name" required>
            
            <!-- due date -->
            <label for="due_date">due date:</label>
            <input type="date" id="due_date" name="due_date" required>
            
            <!-- priority selection -->
            <label for="priority">priority:</label>
            <select id="priority" name="priority">
                <option value="5">high (5)</option>
                <option value="4">4</option>
                <option value="3">medium (3)</option>
                <option value="2">2</option>
                <option value="1">low (1)</option>
            </select>
            
            <!-- prerequisites input (e.g., comma-separated task ids) -->
            <label for="prerequisites">prerequisite tasks (comma separated ids):</label>
            <input type="text" id="prerequisites" name="prerequisites">
            
            <!-- flags for task attributes -->
            <label for="flag_under_resourced">
                <input type="checkbox" id="flag_under_resourced" name="flag_under_resourced">
                under resourced
            </label>
            <label for="flag_requires_training">
                <input type="checkbox" id="flag_requires_training" name="flag_requires_training">
                requires more training
            </label>
            
            <button type="submit">create task</button>
        </form>
    <?php else: ?>
        <?php
        // sample data for employee view; in a real app, pull this from a database
        $totalTasks = 10;
        $completedTasks = 6;
        $historyLog = [
            ['task' => 'task 1', 'status' => 'completed', 'date' => '2025-01-01'],
            ['task' => 'task 2', 'status' => 'overdue', 'date' => '2025-01-05'],
            ['task' => 'task 3', 'status' => 'assigned', 'date' => '2025-01-10']
        ];
        ?>
        <!-- analytics section for employees -->
        <section id="analytics">
            <h2>task analytics</h2>
            <p>completed tasks: <?php echo $completedTasks; ?> / <?php echo $totalTasks; ?></p>
        </section>
        <!-- history log section -->
        <section id="history">
            <h2>task history</h2>
            <table>
                <thead>
                    <tr>
                        <th>task</th>
                        <th>status</th>
                        <th>date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historyLog as $log): ?>
                        <?php 
                        // generate a safe id based on task name
                        $taskId = strtolower(str_replace(' ', '-', $log['task'])); 
                        ?>
                        <tr id="task-<?php echo $taskId; ?>">
                            <td><?php echo $log['task']; ?></td>
                            <td><?php echo $log['status']; ?></td>
                            <td><?php echo $log['date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    <?php endif; ?>
    </div>
    <script src="script.js"></script>
</body>
</html>
