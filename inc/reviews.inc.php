<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

//==========================================================================
// load_reviews
//   Pull reviews from db with the associated target id
//==========================================================================
function load_reviews( $member_id ) {

    $query_string = "select members.name, members.picture, reviews.rating, reviews.content
        FROM members, reviews WHERE reviews.target_id=? and reviews.target_id=members.member_id limit 10;";

    $query_params = [$member_id];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // PLACEHOLDER: error handling
        die("Failed to pull reviews");
    }

    return $result;
}

?>