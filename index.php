<?php
/**
 * Created by PhpStorm.
 * User: Sj
 * Date: 3/25/2023
 * Time: 8:34 PM
 */
include "init.php";

//$conn = new Db_connect;

//var_dump( $conn );
echo "Tested";

function aaa() {
//    var_dump( $_SERVER);
    // Load the original image file
    $img = "/Applications/MAMP/htdocs/movie_api/images/uploads/1679995514.jpeg";
    $src_image = imagecreatefromjpeg( $img );



// Get the current width and height of the image
    $src_width = imagesx($src_image);
    $src_height = imagesy($src_image);



// Calculate the new height based on the desired width of 500 pixels
    $new_width = 500;
    $new_height = round($src_height * ($new_width / $src_width));


// Create a new image with the desired size
    $dst_image = imagecreatetruecolor($new_width, $new_height);



// Resize the image
    imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $new_width, $new_height, $src_width, $src_height);

    var_dump( $dst_image  );
// Output the resized image to a file or to the browser
    imagejpeg($dst_image, 'resized_image.jpeg', 80); // or imagejpeg() or imagegif()
    header('Content-Type: image/jpeg'); // or image/jpeg or image/gif
    imagejpeg($dst_image, null, 80); // or imagejpeg() or imagegif()

}

aaa();
?>



