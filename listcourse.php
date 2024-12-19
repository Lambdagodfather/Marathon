<?php
// Load all the required classes in /lib directory
spl_autoload_register(function($class) {
    include __DIR__ . "/lib/" . $class . '.php';
});
// Define AD class and DB class
$ad = new AD();
$courses = $ad->getCourses();
// Take all the courses from the database
$courses = $ad->getCourses();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Events</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .event-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .event-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .date-badge {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: bold;
            position: absolute;
            top: 15px;
            left: 15px;
            border-radius: 5px;
            padding: 5px 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .event-title {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .btn-join {
            background-color: black;
            color: white;
            width: 100%;
            border: none;
        }

        .btn-join:hover {
            background-color: #333;
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 1.5rem;
            color: black;
            text-decoration: none;
            z-index: 10;
        }

        .back-button:hover {
            color: #555;
        }
    </style>
</head>
<body>
    <!-- Back Button -->
    <a href="index.php" class="back-button">&larr;</a>
    <div class="container my-5">
        <h1 class="text-center mb-5">Upcoming Events</h1>
        <div class="row g-4">
            
            <!-- Add more cards if needed -->
            <?php while($course = $courses->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card event card position-relative">
                        <img src="<?php echo $course["image"]; ?>" alt="Event Image">
                        <div class="date-badge text-center"><?php echo date("M", strtotime($course["time"])); ?><br><?php echo date("d", strtotime($course["time"])); ?></div>
                        <div class="card-body text-center">
                            <h5 class="event-title"><?php echo $course["name"]; ?></h5>
                            <p><?php echo date("D H:i", strtotime($course["time"])); ?> • <?php echo $course["address"]; ?></p>
                            <a href="course.php?id=<?php echo $course["id"]; ?>" class="btn btn-join">Join</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
