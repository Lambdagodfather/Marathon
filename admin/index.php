<?php
session_start();
// Load all the required classes in /lib directory
spl_autoload_register(function($class) {
    include __DIR__ . "/../lib/" . $class . '.php';
});
// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
// Define AD class and DB class
$db = new DB();
$ad = new AD();
$courses = $ad->getCourses();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_FILES, $_POST, $_FILES);
    $ad->createCourse($_POST, $_FILES);
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Homepage</title>
</head>
<body>
    <h1>Welcome to Admin Homepage</h1>
    <a href="logout.php">Logout</a>

    <h2>Create Course</h2>
    <form method="post" action="index.php" enctype="multipart/form-data">
    <label for="name">Course Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="address">Course Address:</label>
    <input type="text" id="address" name="address" required><br><br>

    <label for="time">Course Time:</label>
    <input type="datetime-local" id="time" name="time" required><br><br>

    <label for="range">Course Range:</label>
    <input type="number" id="range" name="range" step="0.01" required><br><br>
    <label for="image">Course Image:</label>
    <input type="file" id="image" name="image" accept="image/*"><br><br>

    <input type="submit" value="Create Course">
    </form>

    <h2>List of Courses</h2>
    <ul>
    <?php while($course = $courses->fetch_assoc()): ?>
        <li>
            <a href="course.php?id=<?php echo $course["id"]; ?>"><?php echo $course["name"]; ?></a>
        </li>
    <?php endwhile; ?>
    </ul>
</body>
</html>
