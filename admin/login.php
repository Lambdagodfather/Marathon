<?php
// Load all the required classes in /lib directory
spl_autoload_register(function($class) {
    include __DIR__ . "/../lib/" . $class . '.php';
});
session_start();
// Check if the user is logged in or not, if logged in then redirect to admin/index.php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}
// Define AD class and DB class
$db = new DB();
$ad = new AD();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if ($ad->validateLogin($username, $password)) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        header("location: index.php");
    } else {
        echo "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>