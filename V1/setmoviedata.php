<?php
/**
 * Created by PhpStorm.
 * User: Sj
 * Date: 3/25/2023
 * Time: 10:34 PM
 */
include "../init.php";


// check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // get the data from the request body
    $POST = json_decode(file_get_contents('php://input'), true);

    // validate the data (you can add your own validation logic here)
    if ( isset($POST['name']) && isset($POST['email']) && isset($POST['password']) ) {

        if ( !empty($POST['name']) && !empty($POST['email']) && !empty($POST['password']) ) {
//            $conn = new Db_connect;
            // insert the data into your database

            $mysqli = Db_connect::getInstance()->getConnection();

            $isertId = upload_users_data( $mysqli, $POST );

            if($isertId) {
                $response = array('status' => 'success', 'message' => 'Data is successfully submitted');
            }else {
                $response = array('status' => 'error', 'message' => 'Data is not successfully submitted because of Mysql error');
            }

        } else {

            $response = array('status' => 'error', 'message' => 'Data is not successfully submitted because of Empty data');
        }

    } else {
        // return an error message if the data is not valid
        $response = array('status' => 'error', 'message' => 'Data is not loaded successfully submitted of Invalid data');
    }

}
else if( $_SERVER['REQUEST_METHOD'] == 'GET' ) {

//    $_GET= json_decode(file_get_contents('php://input'), true);

//    var_dump( $_GET['ids_str']);
    $mysqli = Db_connect::getInstance()->getConnection();

    $loaded_ids_str = $_GET['ids_str'];
    $loaded_ids = str_replace('"', '', $loaded_ids_str);
    $response = movie_data( $mysqli );

} else {
    // return an error message if the request method is not POST
    $response = array('status' => 'error', 'message' => 'Data is not successfully submitted because of Invalid request method');
    echo json_encode($response);
}

echo json_encode($response);
