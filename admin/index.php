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
    $ad->createCourse($_POST, $_FILES);
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="text-center mb-4">Welcome to Admin Homepage</h1>

        <div class="card mb-5">
            <div class="card-header bg-primary text-white">Create Course</div>
            <div class="card-body">
                <form method="post" action="index.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Course Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Course Address:</label>
                        <input type="text" id="address" name="address" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Course Time:</label>
                        <input type="datetime-local" id="time" name="time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="range" class="form-label">Course Range:</label>
                        <input type="number" id="range" name="range" step="0.01" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Course Image:</label>
                        <input type="file" id="image" name="image" accept="image/*" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Course</button>
                </form>
            </div>
        </div>

        <h2 class="text-center mb-4">List of Courses</h2>
        <ul class="list-group">
            <?php while($course = $courses->fetch_assoc()): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="course.php?id=<?php echo $course["id"]; ?>" class="text-decoration-none">
                        <?php echo htmlspecialchars($course["name"]); ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
