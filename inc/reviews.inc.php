<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

if( is_logged_in() ) {
    $session_start;
    $member_id = $_SESSION["member_id"];
    if( isset($_POST["target_Id"]) and isset($_POST["review_rating"]) and isset($_POST["review_content"]) ) {
        upload_review( $member_id, $_POST["target_Id"], $_POST["review_rating"], $_POST["review_content"] );
    }
}

//==========================================================================
// load_reviews
//   Pull reviews from db with the associated target id
//==========================================================================
function load_reviews( $member_id ) {

    $query_string = "select members.name, members.picture, reviews.rating, reviews.content
        FROM members left join reviews on reviews.member_id=members.member_id WHERE reviews.target_id=? limit 10;";

    $query_params = [$member_id];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // PLACEHOLDER: error handling
        die("Failed to pull reviews");
    }

    return $result;
}

//==========================================================================
// upload_review
//   Inserts a review to the db
//==========================================================================
function upload_review( $member_id, $target_id, $rating, $content ) {
    
    $query_string = "INSERT INTO reviews WHERE (?,?,?,?);";

    $query_params = [$member_id, $target_id, $rating, $content];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // PLACEHOLDER: error handling
        die("Failed to upload review");
    }

    return $result;
}


//  Call this function when data changes
function refresh(){
    if (upload_review() === true){
        header( "location: ../accountManagement.php" );
        header("location: ../ViewOthersProfile.php");
    }
    else die("Something went Wrong");
}

?>