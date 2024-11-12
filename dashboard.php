<?php
session_start();
include 'lib/functions.php';
if (!isset($_SESSION['user_id'])) header("Location: index.php");

$assistant = new PersonalAssistant();
$userId = $_SESSION['user_id'];
$tasks = $assistant->getTasks($userId);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_name'])) {
    $taskName = $_POST['task_name'];
    $taskDate = $_POST['task_date'];
    $assistant->addTask($userId, $taskName, $taskDate);
    header("Refresh:0");  // Refresh page to display the new task
}

if (isset($_GET['delete'])) {
    $assistant->deleteTask($_GET['delete']);
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h2>Welcome to Your Personal Assistant</h2>

    <!-- Task Form -->
    <form method="POST">
        <input type="text" name="task_name" placeholder="Task" required><br>
        <input type="datetime-local" name="task_date" required><br>
        <button type="submit">Add Task</button>
    </form>

    <!-- Task List -->
    <h3>Your Tasks</h3>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <?php echo $task['task_name'] . " - " . $task['task_date']; ?>
                <a href="dashboard.php?delete=<?php echo $task['id']; ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
