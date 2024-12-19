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
    // Validate update register
    public function updateRegister($data) {
        $course_id = $data["course_id"];
        unset($data["course_id"]);
        foreach ($data as $key => $value) {
            // Split the key to get the email 
            $email = explode("_", $key)[1];
            $email = $email . "@gmail.com";
            $update = explode("_", $key)[0];
            if ($update == "record") {
                $sql = "UPDATE register SET record = '$value' WHERE course_id = $course_id AND email = '$email'";
                $result = $this->db->conn->query($sql);
                if (!$result) {
                    echo "Failed to update register";
                    return;
                }
            } else if ($update == "racebib") {
                $sql = "UPDATE register SET racebib = '$value' WHERE course_id = $course_id AND email = '$email'";
                $result = $this->db->conn->query($sql);
                if (!$result) {
                    echo "Failed to update register";
                    return;
                }
            }
            // Sort the register
            $this->sortRegister($course_id);
            
        }
    }
    // Sort register by record without null or 00:00:00
    public function sortRegister($course_id) {
        $sql = "SELECT * FROM register WHERE course_id = $course_id AND record IS NOT NULL AND record != '00:00:00' ORDER BY record";
        $result = $this->db->conn->query($sql);
        // Set the standing
        $i = 1;
        while ($register = $result->fetch_assoc()) {
            $sql = "UPDATE register SET standing = $i WHERE course_id = $course_id AND email = '" . $register["email"] . "'";
            $this->db->conn->query($sql);
            $i++;
        }

    }
}
?>