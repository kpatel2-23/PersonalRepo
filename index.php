<?php
// start session to persist data
session_start();

// if an employee email is passed in the url, save it to session
if (isset($_GET['employee_email'])) {
    $_SESSION['employee_email'] = $_GET['employee_email'];
}
$employeeEmail = isset($_SESSION['employee_email']) ? $_SESSION['employee_email'] : 'no-email@example.com';

// sample data for projects that this employee belongs to
$projects = [
    [
        'name' => 'project alpha',
        'team_leader' => ['name' => 'alice', 'contact' => 'alice@example.com'],
        'manager' => ['name' => 'bob', 'contact' => 'bob@example.com']
    ],
    [
        'name' => 'project beta',
        'team_leader' => ['name' => 'charlie', 'contact' => 'charlie@example.com'],
        'manager' => ['name' => 'david', 'contact' => 'david@example.com']
    ]
];

// sample data for tasks assigned to this employee
$tasks = [
    [
        'name' => 'task 1',
        'due_date' => '2025-01-01',
        'priority' => 5,
        'prerequisites' => 'none'
    ],
    [
        'name' => 'task 2',
        'due_date' => '2025-01-05',
        'priority' => 3,
        'prerequisites' => 'task 1'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>employee dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="container">
        <h1>employee dashboard</h1>
        <p>email: <?php echo htmlspecialchars($employeeEmail); ?></p>
    </header>
    <div class="container">
        <!-- display projects and associated contacts -->
        <section id="projects">
            <h2>projects</h2>
            <?php foreach ($projects as $project): ?>
                <div class="project-card">
                    <h3><?php echo htmlspecialchars($project['name']); ?></h3>
                    <p>team leader: <?php echo htmlspecialchars($project['team_leader']['name']); ?> (<?php echo htmlspecialchars($project['team_leader']['contact']); ?>)</p>
                    <p>manager: <?php echo htmlspecialchars($project['manager']['name']); ?> (<?php echo htmlspecialchars($project['manager']['contact']); ?>)</p>
                </div>
            <?php endforeach; ?>
        </section>

        <!-- display tasks as cards -->
        <section id="tasks">
            <h2>tasks</h2>
            <?php foreach ($tasks as $index => $task): ?>
                <div class="task-card" id="task-<?php echo $index; ?>">
                    <h3><?php echo htmlspecialchars($task['name']); ?></h3>
                    <p>due date: <?php echo htmlspecialchars($task['due_date']); ?></p>
                    <p>priority: <?php echo htmlspecialchars($task['priority']); ?></p>
                    <p>prerequisites: <?php echo htmlspecialchars($task['prerequisites']); ?></p>
                    <!-- flag icons to indicate under resourced or training needed -->
                    <div class="flags">
                        <span class="flag" data-flag="under_resourced" onclick="toggleFlag(this)">under resourced</span>
                        <span class="flag" data-flag="training_needed" onclick="toggleFlag(this)">needs training</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
    <script src="script.js"></script>
</body>
</html>
