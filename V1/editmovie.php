<?php
include "../init.php";

header('Content-Type: application/json');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn = Db_connect::getInstance()->getConnection();
    // Get the input values from the form

//    var_dump( $_FILES );
//    $DOCUMENT_ROOT= $_SERVER['DOCUMENT_ROOT'];
//    $target_dir = "/Applications/MAMP/htdocs/movie_api/images/uploads/";
//    $target_dir = $DOCUMENT_ROOT."/movie_api/images/uploads/";
//    $target_file = $target_dir . basename($_FILES["profileImage"]["name"]);
//    move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file );


    $hostname = $_SERVER['HTTP_HOST'];
//    $imageUrl = $hostname."/movie_api/images/uploads/".basename($_FILES["profileImage"]["name"]);


    if(isset($_POST)) {
        $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $result = array('result' => 'res_code' ,'msg' => 'File is not an image file' );
            echo json_encode($result);
            $uploadOk = 0;
        }

        if ($_FILES["profileImage"]["size"] > 40000000) {
            $result = array('result' => 'res_code' ,'msg' => 'File is so lage please select less than 4mb image file' );
            $uploadOk = 0;
        }else {
            $uploadOk = 1;
        }

        $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
        $target_dir = $DOCUMENT_ROOT."/movie_api/images/uploads/";
        $target_file = $target_dir . basename($_FILES["profileImage"]["name"]);
//Here we are getting the file extension if you want, you can use this code
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(file_exists($target_file)) {
            var_dump( "ok" );
            chmod($target_file , 0755); //Change the file permissions if allowed
            unlink($target_file); //remove the file
        }

        $temp = explode(".", $_FILES["profileImage"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);

        move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_dir."/".$newfilename );

//        $imageUrl = $hostname."/movie_api/images/uploads/".basename($_FILES["profileImage"]["name"]);

    }

    // Check file size






//    $use =
    $result =array (
        'success'=> true
    );

}

echo json_encode( $result);

