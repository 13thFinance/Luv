<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

if( isset($_POST["member_id"]) and isset($_POST["target_id"]) ) {
    
    confirm_match_receipt( $_POST["member_id"], $_POST["target_id"] );
}

function confirm_match_receipt( $member_id, $target_id ) {
    $query_string = "update matches set delivered=1 where member_id=? and target_id=?";
    $query_params = [$member_id, $target_id];
    db_query( $query_string, $query_params );
}
?>