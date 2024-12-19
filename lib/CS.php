<?php
// Load all the required classes in /lib directory
spl_autoload_register(function($class) {
    include __DIR__ . "/../lib/" . $class . '.php';
});
class CS {
    private $db;
    public function __construct() {
        $this->db = new DB();
    }
    // Get all the courses
    public function getCourses() {
        $sql = "SELECT * FROM course";
        $result = $this->db->conn->query($sql);
        return $result;
    }
    // Get the course by id
    public function getCourse($id) {
        $sql = "SELECT * FROM course WHERE id = $id";
        $result = $this->db->conn->query($sql);
        $course = $result->fetch_assoc();
        return $course;
    }
    // Validate the data register
    public function validateRegister($data) {
        $errors = [];
        // Name in range 3-100
        if (strlen($data["name"]) < 3 || strlen($data["name"]) > 100) {
            $errors[] = "Name should be in range 3-100";
        }
        // Email with valid format
        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
        // Email and course_id is unique
        $sql = "SELECT * FROM register WHERE email = '" . $data["email"] . "' AND course_id = " . $data["course_id"];
        $result = $this->db->conn->query($sql);
        if ($result->num_rows > 0) {
            $errors[] = "Email already registered for this course";
        }
        // Phone with valid format
        if (!preg_match("/^[0-9]{10,15}$/", $data["phone"])) {
            $errors[] = "Invalid phone format";
        }
        // Phone and course_id is unique
        $sql = "SELECT * FROM register WHERE phone = '" . $data["phone"] . "' AND course_id = " . $data["course_id"];
        $result = $this->db->conn->query($sql);
        if ($result->num_rows > 0) {
            $errors[] = "Phone already registered for this course";
        }
        // Passport with valid format
        if(isset($data["passport"]) && $data["passport"] != "") {
            if (!preg_match("/^[A-Z]{2}[0-9]{7}$/", $data["passport"])) {
                $errors[] = "Invalid passport format";
            }
            // Passport and course_id is unique
            $sql = "SELECT * FROM register WHERE passport = '" . $data["passport"] . "' AND course_id = " . $data["course_id"];
            $result = $this->db->conn->query($sql);
            if ($result->num_rows > 0) {
                $errors[] = "Passport already registered for this course";
            }
        }
        // Birthdate for age 18-80
        $birthdate = date("Y-m-d", strtotime($data["birthdate"]));
        $age = date_diff(date_create($birthdate), date_create('now'))->y;
        if ($age < 18 || $age > 80) {
            $errors[] = "Age should be in range 18-80";
        }
        return $errors;
    }
    // Register a new user
    public function register($data) {
        // Validate the data
        $errors = $this->validateRegister($data);
        if (count($errors) > 0) {
            return $errors;
        }
        // Insert the data
        $sql = "INSERT INTO register (course_id, name, email, birthdate, nationality,";
        if (isset($data['passport']) && $data['passport'] != "") {
            $sql .= " passport,";
        }
        if (isset($data['hotel']) && $data['hotel'] != "") {
            $sql .= " hotel,";
        }
        $sql .= " gender, phone, address) VALUES (" . $data["course_id"] . ", '" . $data["name"] . "', '" . $data["email"] . "', '" . $data["birthdate"] . "', '" . $data['nationality'] . "',";
        if (isset($data['passport']) && $data['passport'] != "") {
            $sql .= " '" . $data["passport"] . "',";
        }
        if (isset($data['hotel']) && $data['hotel'] != "") {
            $sql .= " '" . $data["hotel"] . "',";
        }
        $sql .= " '" . $data['gender'] . "', '" . $data['phone'] . "', '" . $data['address'] . "')";
        $result = $this->db->conn->query($sql);
        if ($result) {
            return;
        } else {
            return ["Failed to register"];
        }

    }
    public function getInformation($email){
        $sql = "SELECT * FROM register WHERE email = '$email'";
        $result = $this->db->conn->query($sql);
        if ($result->num_rows == 0) {
            return false;
        }
        $result = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($result as $key => $row) {
            $course_id = $row['course_id'];
            $sql = "SELECT * FROM course WHERE id = $course_id";
            $results = $this->db->conn->query($sql);
            $course = $results->fetch_assoc();
            $result[$key]['course'] = $course;
        }
        return $result;
    }
}