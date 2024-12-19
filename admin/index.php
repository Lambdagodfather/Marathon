<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Homepage</title>
</head>
<body>
    <h1>Welcome to Admin Homepage</h1>
    <a href="?action=logout">Logout</a>

    <h2>Create Course</h2>
    <form method="post" action="">
        <label for="course_name">Course Name:</label>
        <input type="text" id="course_name" name="course_name" required>
        <br>
        <label for="course_description">Course Description:</label>
        <textarea id="course_description" name="course_description" required></textarea>
        <br>
        <button type="submit" name="create_course">Create Course</button>
    </form>

    <h2>List of Courses</h2>
    <ul>
        <li>Course 1</li>
        <li>Course 2</li>
        <li>Course 3</li>
    </ul>
</body>
</html>
