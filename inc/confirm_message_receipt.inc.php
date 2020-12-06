<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

if( isset($_POST["member_id"]) and isset($_POST["target_id"]) and 
    isset($_POST["timestamp"]) and isset($_POST["is_recipient"]) ) {
    confirm_message_receipt( $_POST["member_id"], $_POST["target_id"], $_POST["timestamp"], $_POST["is_recipient"] );
}

function confirm_message_receipt( $member_id, $target_id, $timestamp, $is_recipient ) {
    LOG_DEBUG( "Confirming message" );
    $query_string = "";
    $query_params = [];

    if( $is_recipient == "false" ) {
        $query_string = "update messages set delivered=? where member_id=? and target_id=? and timestamp=?";
        $query_params = ["1", $member_id, $target_id, $timestamp];
    }
    elseif( $is_recipient == "true" ) {
        LOG_DEBUG( "marking read: $member_id, $target_id, $timestamp ");
        $query_string = "update messages set `read`=? where member_id=? and target_id=? and timestamp=?";
        $query_params = ["1", $target_id, $member_id, $timestamp];
    }
    
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // PLACEHOLDER
        die( "Something went wrong" );
    }
    LOG_DEBUG( "update messages set `read`=\"1\" where member_id=$target_id and target_id=$member_id and timestamp=$timestamp" );
}
?>