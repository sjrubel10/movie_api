<?php

/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 5/3/2017
 * Time: 3:33 PM
 */
class Db_connect
{
    private $_connection;
    private static $_instance; //The single instance
    private $_host = "localhost";
    private $_username = "wpdbuser";
    private $_password = "";
    private $_database = "movie";
    /*
    Get an instance of the Database
    @return Instance
    */
    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    // Constructor
    private function __construct() {
        $this->_connection = new mysqli(
            $this->_host, $this->_username,
            $this->_password, $this->_database
        );

        // Error handling
        if(mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysqli_connect_error(), E_USER_ERROR);
        }
    }
    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }
    // Get mysqli connection
    public function getConnection() {
        return $this->_connection;
    }
}


function db_connect($host,$user,$pass,$db) {


    $mysqli = new mysqli($host, $user, $pass, $db);

    $mysqli->set_charset("utf8");

    if($mysqli->connect_error)
        die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

    return $mysqli;
}

