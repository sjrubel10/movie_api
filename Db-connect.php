<?php
/**
 * Created by PhpStorm.
 * User: Sj
 * Date: 3/25/2023
 * Time: 8:36 PM
 */

class Db_connect {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "movie";
    private $conn;

    public function __construct() {
//        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function connect() {

        return $this->conn;

    }

    public function close() {
        $this->conn->close();
    }
}
