<?php
spl_autoload_register(function($class) {
    include $class . '.php';
});
class AD {
    private $db;

    public function __construct($codb) {
        $this->db = new DB();
    }

    public function validateLogin($username, $password) {
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $this->db->conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

}
?>