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
// Check parameters
if (!isset($_GET["id"])) {
    header("location: index.php");
    exit;
}
// Get the course details
$course = $ad->getCourse($_GET["id"]);
// Validate the course
if (!$course) {
    header("location: index.php");
    exit;
}
// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $errors =  $ad->updateCourse($_POST, $_FILES);
    // if (empty($errors)) {
    //     header("location: index.php");
    //     exit;
    // }
    // header("location: register.php");
    var_dump($_POST);
    // exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('../images/list_back.png') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 24px;
            color: #fff;
        }
    </style>
</head>
<body>
    <a href="index.php" class="back-button">&larr;</a>
    <div class="container">
        <div class="text-center">
            <h1 class="text-dark fw-bold mt-4">Register List</h1>
        </div>
        <br>
        <p class="text-dark fw-bold">Course: <?php echo $course["name"]; ?></p>
        <p class="text-dark fw-bold">Address: <?php echo $course["address"]; ?></p>
        <p class="text-dark fw-bold">Time: <?php echo $course["time"]; ?></p>
        <p class="text-dark fw-bold">Range: <?php echo $course["ranges"]; ?> km</p>
        <br>
        <div class="table-container mx-auto">
            <form method="post" action="course.php?id=<?php echo $course["id"]; ?>">
                <input type="hidden" name="course_id" value="<?php echo $course["id"]; ?>">
                
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Birthdate</th>
                        <th>Nationality</th>
                        <th>Passport</th>
                        <th>Hotel</th>
                        <th>Record</th>
                        <th>Race Bib</th>
                        <th>Standing</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($course["register"] as $register): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $register["name"]; ?></td>
                        <td><?php echo $register["email"]; ?></td>
                        <td><?php echo $register["phone"]; ?></td>
                        <td><?php echo $register["address"]; ?></td>
                        <td><?php echo strtoupper($register['gender']); ?></td>
                        <td><?php echo $register["birthdate"]; ?></td>
                        <td><?php echo strtoupper($register['nationality']); ?></td>
                        <td><?php echo $register["passport"]? $register["passport"] : 'N/A'; ?></td>
                        <td><?php echo $register["hotel"]? $register["hotel"] : 'N/A'; ?></td>
                        <td style="width:10%"><input type="text" class="form-control" name="record_<?php echo $register["racebib"] . '_' . $register['course_id'] ?>" value="<?php echo $register["record"] ?? ''; ?>" style="width:100%"></td>
                        <td style="width:10%"><input type="text" class="form-control" name="racebib_<?php echo $register["email"] . '_' . $register['course_id'] ?>" value="<?php echo $register["racebib"] ?? ''; ?>" style="width:100%"></td>
                        <td><?php echo $register["standing"] ?? 'N/A'; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <input type="submit" class="btn btn-primary w-100" value="Update">
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
