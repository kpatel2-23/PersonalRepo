<?php
session_start();

// Capture employee name from URL (for now) and store in session
if (isset($_GET['employee_name'])) {
    $_SESSION['employee_name'] = $_GET['employee_name'];
}
$employeeName = isset($_SESSION['employee_name']) ? $_SESSION['employee_name'] : 'John Doe';

// Dummy project data (to be replaced by database queries later)
$projects = [
    [
        'name' => 'Project Alpha',
        'team_leader' => ['name' => 'Alice', 'contact' => 'alice@example.com'],
        'manager' => ['name' => 'Bob', 'contact' => 'bob@example.com']
    ],
    [
        'name' => 'Project Beta',
        'team_leader' => ['name' => 'Charlie', 'contact' => 'charlie@example.com'],
        'manager' => ['name' => 'David', 'contact' => 'david@example.com']
    ],
    [
        'name' => 'Project Gamma',
        'team_leader' => ['name' => 'Eva', 'contact' => 'eva@example.com'],
        'manager' => ['name' => 'Frank', 'contact' => 'frank@example.com']
    ]
];

// Dummy task data (later to come from a database)
$tasks = [
    [
        'name' => 'Design UI Mockup',
        'description' => 'Create a mockup for the new dashboard design.',
        'due_date' => '2025-01-15',
        'team_leader' => 'Alice',
        'manager' => 'Bob'
    ],
    [
        'name' => 'Implement Authentication',
        'description' => 'Develop secure login functionality using OAuth.',
        'due_date' => '2025-01-20',
        'team_leader' => 'Charlie',
        'manager' => 'David'
    ],
    [
        'name' => 'Database Optimization',
        'description' => 'Optimize database queries and indexing.',
        'due_date' => '2025-01-25',
        'team_leader' => 'Eva',
        'manager' => 'Frank'
    ],
    [
        'name' => 'Write Unit Tests',
        'description' => 'Develop comprehensive unit tests for the new module.',
        'due_date' => '2025-02-01',
        'team_leader' => 'Alice',
        'manager' => 'Bob'
    ]
];

// For the "Recent Tasks" section, we take the last 3 tasks.
$recentTasks = array_slice($tasks, -3);

// Dummy analytics data
$analytics = [
    'tasks_completed' => 60,  // in percent
    'tasks_overdue'   => 2,
    'tasks_pending'   => 4
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header with employee name -->
    <header>
        <h1><?php echo htmlspecialchars($employeeName); ?></h1>
    </header>
    
    <div class="container">
        <!-- Left Sidebar: Navigation with Projects -->
        <aside id="sidebar">
            <h2>Navigation</h2>
            <div class="projects">
                <?php foreach ($projects as $project): ?>
                    <div class="project-box">
                        <h3><?php echo htmlspecialchars($project['name']); ?></h3>
                        <p><strong>Team Leader:</strong> <?php echo htmlspecialchars($project['team_leader']['name']); ?></p>
                        <p><strong>Manager:</strong> <?php echo htmlspecialchars($project['manager']['name']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </aside>
        
        <!-- Main Content: Recent Tasks and Analytics -->
        <main id="main-content">
            <!-- Recent Tasks Section -->
            <section id="recent-tasks">
                <h2>Recent Tasks</h2>
                <div class="tasks">
                    <?php foreach ($recentTasks as $task): ?>
                        <div class="task-card">
                            <h3><?php echo htmlspecialchars($task['name']); ?></h3>
                            <p><?php echo htmlspecialchars($task['description']); ?></p>
                            <p><strong>Due Date:</strong> <?php echo htmlspecialchars($task['due_date']); ?></p>
                            <p><strong>Team Leader:</strong> <?php echo htmlspecialchars($task['team_leader']); ?></p>
                            <p><strong>Manager:</strong> <?php echo htmlspecialchars($task['manager']); ?></p>
                            <div class="flags">
                                <span class="flag" data-flag="under_resourced" onclick="toggleFlag(this)">Under-Resourced</span>
                                <span class="flag" data-flag="requires_training" onclick="toggleFlag(this)">Requires More Training</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
            
            <!-- Analytics Section -->
            <section id="analytics">
                <h2>Analytics</h2>
                <div class="analytics-data">
                    <p><strong>Tasks Completed:</strong> <?php echo $analytics['tasks_completed']; ?>%</p>
                    <p><strong>Overdue Tasks:</strong> <?php echo $analytics['tasks_overdue']; ?></p>
                    <p><strong>Pending Tasks:</strong> <?php echo $analytics['tasks_pending']; ?></p>
                </div>
            </section>
        </main>
    </div>
    
    <script src="script.js"></script>
</body>
</html>
