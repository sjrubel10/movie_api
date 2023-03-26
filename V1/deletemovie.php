<?php
/**
 * Created by PhpStorm.
 * User: Sj
 * Date: 3/26/2023
 * Time: 9:51 PM
 */

include "../init.php";

if( $_SERVER['REQUEST_METHOD'] == 'GET' ) {

//    $GET= json_decode(file_get_contents('php://input'), true);
    $mysqli = Db_connect::getInstance()->getConnection();
    $movieId = (int)$_GET["deleteId"];

    $result = delete_existing_movie( $mysqli, $movieId );

    $response = array('status' => 'success', 'message' => 'Data is successfully deleted');
//    $response = movie_data( $mysqli );
//    $response = [];

} else {
    // return an error message if the request method is not POST
    $response = array('status' => 'error', 'message' => 'Data is not successfully submitted because of Invalid request method');

}

echo json_encode( $response );