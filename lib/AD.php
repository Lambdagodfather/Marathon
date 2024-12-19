<?php
spl_autoload_register(function($class) {
    include $class . '.php';
});
class AD {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }
    // Validate the login
    public function validateLogin($username, $password) {
        $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
        $result = $this->db->conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    // Create a new course
    public function createCourse($data, $image) {
        $image = $image["image"];
        // Check time in future
        if (strtotime($data["time"]) < time()) {
            echo "Time should be in future";
            return;
        }
        // Check range is positive
        if ($data["range"] < 0) {
            echo "Range should be positive";
            return;
        }
        // Handle the image upload
        $target_dir = __DIR__ . "/../images/courseimg/";
        $target_file = $target_dir . basename($image["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($image["tmp_name"]);
        if ($check === false) {
            echo "File is not an image";
            return;
        }
        if ($image["size"] > 500000) {
            echo "File is too large";
            return;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Only JPG, JPEG, PNG files are allowed";
            return;
        }
        if (!move_uploaded_file($image["tmp_name"], $target_file)) {
            echo "Failed to upload image";
            return;
        }
        $url = "images/courseimg/" . basename($image["name"]);
        // Insert the course into database
        $sql = "INSERT INTO course (name, address, time, ranges, image) VALUES ('" . $data["name"] . "', '" . $data["address"] . "', '" . $data["time"] . "', " . $data["range"] . ", '$url')";
        $result = $this->db->conn->query($sql);
        if ($result) {
            echo "Course created successfully";
        } else {
            echo "Failed to create course";
        }
    }
    // Get all the courses
    public function getCourses() {
        $sql = "SELECT * FROM course";
        $result = $this->db->conn->query($sql);
        return $result;
    }
    // Get the course details
    public function getCourse($id) {
        $sql = "SELECT * FROM course WHERE id = $id";
        $result = $this->db->conn->query($sql);
        $course = $result->fetch_assoc();
        // Validate the course
        if (!$course) {
            echo "Course not found";
            return;
        }
        // Get all the registers for the course
        $sql = "SELECT * FROM register WHERE course_id = $id";
        $result = $this->db->conn->query($sql);
        $registers = [];
        while ($register = $result->fetch_assoc()) {
            $registers[] = $register;
        }
        $course["register"] = $registers;

        return $course;
    }

}
?>