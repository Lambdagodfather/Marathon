<?php
// Load all the required classes in /lib directory
spl_autoload_register(function($class) {
    include __DIR__ . "/lib/" . $class . '.php';
});
// Define AD class and DB class
$db = new DB();
$courses = new CS();
// Get id from the URL
$id = $_GET["id"] ?? null;
if ($id === null) {
    header("location: index.php");
    exit;
}
// Get the course by id
$course = $courses->getCourse($id);
if ($course === null) {
    header("location: index.php");
    exit;
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors =  $courses->register($_POST);
    if (empty($errors)) {
        header("location: index.php");
        exit;
    }
    // header("location: register.php");
    // exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('images/reg_back.png') no-repeat center center/cover;
            height: 100vh;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .form-container {
            position: relative;
            z-index: 2;
            max-width: 400px;
            margin: auto;
            margin-top: 5%;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }
        .form-container h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 10px;
            color: #fff;
        }
        .form-container h2 {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #000;
        }
        .form-container input {
            margin-bottom: 10px;
            height: 40px;
        }
        .btn-register {
            background-color: black;
            color: white;
            width: 100%;
        }
        .btn-register:hover {
            background-color: #444;
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <h2>Register for this course</h2>
        <!-- Info of course -->
        <p><strong>Name:</strong> <?php echo $course["name"]; ?></p>
        <p><strong>Address: </strong> <?php echo $course["address"]; ?></p>
        <p><strong>Time: </strong> <?php echo $course["time"]; ?></p>
        <p><strong>Range: </strong> <?php echo $course["ranges"]; ?> km</p>
        <img src="<?php echo $course["image"]; ?>" alt="Course Image" class="img-fluid">
        <div class="mb-3"></div>
        <!-- Register form -->
        <form method="post" action="course.php?id=<?php echo $id; ?>">
            <input type="hidden" name="course_id" value="<?php echo $id; ?>">
            <input type="text" class="form-control" name="name" placeholder="FULL NAME" required>
            <input type="email" class="form-control" name="email" placeholder="example@email.com" required>
            <input type="date" class="form-control" name="birthdate" placeholder="Birthdate" required>
            <input type="text" class="form-control" name="passport" placeholder="Passport">
            <select class="form-select mb-3" name="gender" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
            </select> 
            <select class="form-select mb-3" name="nationality" required>
            <option value="" disabled selected>Select Nationality</option>
            <option value="vn">Vietnam</option>
            <option value="jp">Japan</option>
            <option value="us">United States</option>
            <option value="ca">Canada</option>
            <option value="uk">United Kingdom</option>
            <option value="au">Australia</option>
            <option value="in">India</option>
            <option value="cn">China</option>
            <option value="de">Germany</option>
            <option value="fr">France</option>
            <option value="it">Italy</option>
            <option value="es">Spain</option>
            <option value="br">Brazil</option>
            <option value="za">South Africa</option>
            <option value="ng">Nigeria</option>
            <option value="ru">Russia</option>
            <option value="mx">Mexico</option>
            <option value="kr">South Korea</option>
            </select>
            <input type="text" class="form-control" name="address" placeholder="Address" required>
            <input type="text" class="form-control" name="phone" placeholder="Phone" required>
            <input type="text" class="form-control" name="hotel" placeholder="Hotel">
            <button type="submit" class="btn btn-register mt-3">Register</button>
        </form>
    </div>
</body>

</html>