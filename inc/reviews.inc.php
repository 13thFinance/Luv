<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

if( isset($_POST["member_id"]) and isset($_POST["target_id"]) and 
    isset($_POST["rating"]) and isset($_POST["content"]) ) {
    upload_review( $_POST["member_id"], $_POST["target_id"], $_POST["rating"], $_POST["content"] );
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
    LOG_DEBUG( "mid: $member_id, tid: $target_id, rating: $rating, content: $content" );
    $query_string = "INSERT INTO reviews values (?,?,?,?)";
    $query_params = [$member_id, $target_id, $rating, $content];
    $result = db_query( $query_string, $query_params );
}

//==========================================================================
// has_reviewed
//   Check if this member has reviewed the target member
//==========================================================================
function has_reviewed( $member_id, $target_id ) {

    $query_string = "select count(1) as count from reviews where member_id=? and target_id=?";
    $query_params = [$member_id, $target_id];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // PLACEHOLDER
        die( "Something went wrong" );
    }

    $return = false;
    if( $result[0]["count"] != "0" ) {
        $return = true;
    }

    return $return;
}

?>