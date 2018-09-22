<?php

class Database
{

  
    // default database credentials
    private $host = "localhost";
    private $db_name = "todolist";
    private $username = "root";
    private $password = "123";
    public $conn;
    
    function __construct() {
        $ini_array = parse_ini_file("../../config.ini");
        if (!empty($ini_array)) {
            $this->host = $ini_array['host'];
            $this->db_name = $ini_array['db_name'];
            $this->username = $ini_array['username'];
            $this->password = $ini_array['password'];
        }
    }

    // get the database connection
    public function getConnection()
    {

        $this->conn = null;

        try
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

}
