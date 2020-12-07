<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

function upload_image( $image, $member_id ) {
    // make sure img/profile path exists
    if( !file_exists( "../img/profile" ) ) {
        mkdir('../img', 0775, true);
    }

    $allowed = array( "jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png" );
    $filename = $_FILES["profile_pic"]["name"];
    $filetype = $_FILES["profile_pic"]["type"];
    $filesize = $_FILES["profile_pic"]["size"];

    // verify file extension
    $ext = strtolower( pathinfo($filename, PATHINFO_EXTENSION) );
    if( !array_key_exists($ext, $allowed) ) {
        // PLACEHOLDER: return to account page, throw an error about unallowed file type
        die( "Please select a valid file format." );
    }

    // verify file size - 5 MB max should be enough?
    $maxsize = 5 * 1024 * 1024;
    if( $filesize > $maxsize ) {
        // PLACEHOLDER: return to account page, throw an error about unallowed file type
        die( "File size is larger than the allowed limit." );
    }

    // verify MIME type
    if( in_array($filetype, $allowed) ) {
        // place file in profile pics folder
        $new_filename = $member_id . "." . $ext;
        $new_path = "../img/profile/".$new_filename;
        move_uploaded_file( $_FILES["profile_pic"]["tmp_name"], $new_path );

        // upload file path to members table
        $query_string = "update members set picture=? where member_id=?";
        $query_params = ["img/profile/$new_filename", $member_id];
        $result = db_query( $query_string, $query_params );
        
        if( $result === false ) {
             // PLACEHOLDER: some db error
            die( "Something went wrong" );
        }
    } 
    else {
        // PLACEHOLDER: return to account page, throw an error
        die( "There was a problem uploading your file. Please try again." );
    }
}
?>