<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

if( isset($_POST["member_id"]) and isset($_POST["target_id"]) ) {
    get_match_state( $_POST["member_id"], $_POST["target_id"]);
}

function get_match_state( $member_id, $target_id ) {
    // Did our member click match on the target
    $query_string = "select count(1) as count from matches where member_id=? and target_id=?";
    $query_params = [$member_id, $target_id];
    $result_member_match = db_query( $query_string, $query_params );

    if( $result_member_match === false ) {
        die( "Something went wrong" );
    }

    // Did the target click match on our member
    $query_params = [$target_id, $member_id];
    $result_target_match = db_query( $query_string, $query_params );

    if( $result_target_match === false ) {
        die( "Something went wrong" );
    }

    $member_match = "false";
    $target_match = "false";

    if( $result_member_match[0]["count"] == "1" ) 
        $member_match = "true";
    if( $result_target_match[0]["count"] == "1" )
        $target_match = "true";

    $response = ["member_match" => $member_match, "target_match" => $target_match];

    // echo response if this is an HTTP request, otherwise return it
    if( isset($_POST["member_id"]) and isset($_POST["target_id"]) ) {
        echo json_encode( $response );
    }
    else {
        return json_encode( $response );
    }
}
?>