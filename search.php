<?php
session_start();
// Load all the required classes in /lib directory
spl_autoload_register(function($class) {
    include __DIR__ . "/lib/" . $class . '.php';
});
// Define AD class and DB class
$db = new DB();
$cs = new CS();
// Check parameters
if (!isset($_GET["email"])) {
    header("location: index.php");
    exit;
}
// Get the register list
$registers = $cs->getInformation($_GET["email"]);
// Validate the register list
if (!$registers) {
    header("location: index.php");
    exit;
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
            background: url('images/list_back.png') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #fff;
        }

        .table-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .table {
            color: #333;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <a href="index.php" class="back-btn">&#8592;</a>
        <h1 class="text-center mb-4">Register List</h1>
        <div class="table-container mx-auto">
            <p class="text-dark"><strong>Email:</strong> <?php echo $_GET["email"]; ?></p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Course</th>
                        <th>Record</th>
                        <th>Finishing</th>
                        <th>Date</th>
                        <th>Standing</th>
                        <th>Entry Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($registers)) { ?>
                        <tr>
                            <td colspan="7" class="text-center">No records found</td>
                        </tr>
                    <?php } else { ?>
                    <?php $i = 1; ?>
                    <?php foreach ($registers as $register) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $register["course"]['name']; ?></td>
                            <td><?php echo $register["record"]; ?></td>
                            <td><?php //echo $register["finishing"]; ?></td>
                            <td><?php echo $register["course"]['time']; ?></td>
                            <td><?php echo $register["standing"]; ?></td>
                            <td><?php echo $register["racebib"]; ?></td>
                        </tr>
                    <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
