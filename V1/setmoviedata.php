<?php
/**
 * Created by PhpStorm.
 * User: Sj
 * Date: 3/25/2023
 * Time: 10:34 PM
 */
include "../init.php";

// check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    // get the data from the request body
//    $POST = json_decode(file_get_contents('php://input'), true);
//    var_dump( $_POST );
//    var_dump( $_FILES );

    // validate the data (you can add your own validation logic here)
    if ( isset( $_POST['title']) && isset( $_POST['description']) && isset( $_POST['actors']) ) {

        if ( !empty( $_POST['title']) && !empty($_POST['description']) && !empty( $_POST['actors']) ) {
            $mysqli = Db_connect::getInstance()->getConnection();

            $isertId = upload_movie_data( $mysqli, $_POST );
            $isertId = 1;

            if( $isertId ) {
                $response = array('status' => 'success', 'message' => 'Data is successfully submitted');
            }else {
                $response = array('status' => 'error', 'message' => 'Data is not successfully submitted because of Mysql error');
            }
        }
        else {
            $response = array('status' => 'error', 'message' => 'Data is not successfully submitted because of Empty data');
        }
    } else {
        // return an error message if the data is not valid
        $response = array('status' => 'error', 'message' => 'Data is not loaded successfully submitted of Invalid data');
    }

}
else if( $_SERVER['REQUEST_METHOD'] == 'GET' ) {

    $mysqli = Db_connect::getInstance()->getConnection();

//    var_dump( $_GET );
    if( isset( $_GET ) && !empty( $_GET ) ){
        $loaded_ids_str = $_GET['ids_str'];
        $limit = (int)$_GET['limit'];
        $loaded_ids = str_replace('"', '', $loaded_ids_str);
        $response = movie_data( $mysqli, $loaded_ids, $limit );
    }else{
        $response = array('status' => 'error', 'message' => ' Invalid request ');
    }


} else {
    // return an error message if the request method is not POST
    $response = array('status' => 'error', 'message' => 'Data is not successfully submitted because of Invalid request method');
    echo json_encode($response);
}

echo json_encode($response);
