<?php
session_start();
include 'lib/functions.php';
$assistant = new PersonalAssistant();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = $assistant->login($username, $password);
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
    } else {
        echo "Invalid login.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
