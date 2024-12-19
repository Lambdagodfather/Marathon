<?php
class DB{
    private $host="localhost";
    private $user="root";
    private $pass="";
    private $db="marathon";
    public $conn;
    public function __construct(){
        $this->conn=new mysqli($this->host,$this->user,$this->pass,$this->db);
        if($this->conn->connect_error){
            echo "Failed to connect DB".$this->conn->connect_error;
        }
    }
}