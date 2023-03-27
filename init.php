<?php
/**
 * Created by PhpStorm.
 * User: Sj
 * Date: 3/25/2023
 * Time: 9:33 PM
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include "db_connect.php";
include "functions.php";

$HOST = $_SERVER['REQUEST_URI'];