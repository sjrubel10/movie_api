<?php
/**
 * Created by PhpStorm.
 * User: Sj
 * Date: 3/25/2023
 * Time: 9:34 PM
 */

function upload_users_data( $mysqli,$data) {

    $title = $data['name'];
    $description = $data['email'];
    $actors = $data['password'];

    $query = "INSERT INTO `movie-lists` (`title`, `description`, `actors`) VALUES ( ?, ?, ? )";

    $statement = $mysqli->prepare($query);
    $statement->bind_param('sss',$title,$description,$actors);
    $statement->execute();
    $last_actionid = $statement->insert_id;
    $statement->close();

//    $statement->bind_param('sss',$title,$description,$actors);

    return $last_actionid;

}

function movie_data( $db ) {
    $moviedata = [];
    $id = $title = $description = $actors = null;
//    $db = Db_connect::getInstance()->getConnection();
    $query=" SELECT `id`, `title`, `description`, `actors` FROM `movie-lists` WHERE `is_delete` = 0 ORDER BY `id` DESC ";
    $st = $db->prepare($query);
//    $st->bind_param("i", $video_pointer);
    $st->execute();
    $st->bind_result($id,$title, $description, $actors);
    $st->store_result();
    while( $st->fetch() ){
        $moviedata[]= array(
            'id'=>$id,
            'title'=>$title,
            'description'=>$description,
            'actors'=>$actors
        );
    }

    $st->close();
    return $moviedata;

}

function edit_movie ( $mysqli, $moviedata ) {

    $id = $moviedata["id"];
    $title = $moviedata["title"];
    $description = $moviedata["description"];
    $actors =  $moviedata["actors"];
//    $query=" UPDATE `table_name` SET `title` = '$title', `description` = '$description', `actors` = '$actors'  WHERE id = $id";
    $query=" UPDATE `movie-lists` SET `title` = ?, `description` = ?, `actors` = ?  WHERE id = ?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param('sssi',$title,$description,$actors,$id);
    $statement->execute();
    $statement->close();

    return 1;
}

function delete_existing_movie( $mysqli, $movieId ) {

    $query=" UPDATE `movie-lists` SET `is_delete` = 1 WHERE `id` = ?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param('i', $movieId );
    $statement->execute();
    $statement->close();

    return 1;

}

function resize_image( $original_image ) {

    // Load the original image file
    $src_image = imagecreatefromjpeg( $original_image );

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

// Output the resized image to a file or to the browser
    imagejpeg($dst_image, $dst_image, 80); // Save the image to a file
    header('Content-Type: image/jpeg');
    imagejpeg($dst_image, null, 80); // Output the image to the browser

    return $dst_image;

}