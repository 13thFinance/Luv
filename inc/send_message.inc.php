<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

if( isset($_POST["sender_id"]) and isset($_POST["target_id"]) and isset($_POST["message"]) ) {
    LOG_DEBUG( "post succeeded" );
    send_message( $_POST["sender_id"], $_POST["target_id"], $_POST["message"] );
}

function send_message( $sender_id, $target_id, $message ) {
    // we should know if someone finds a way to message themself
    if( $sender_id === $target_id ) {
        LOG_ERROR( "Attempt made to send message to self. sender_id=$sender_id, target_id=$target_id" );
        return;
    }

    $query_string = "insert into messages values (?,?,now(),?)";
    $query_params = [$sender_id, $target_id, $message];
    $result = db_query( $query_string, $query_params );

    if( !$result ) {
        // JOSH TODO: Just refreshing for now when send fails. Not sure how else we want to handle this.
        LOG_ERROR( "Send message error -- failed to insert sent message into db." .
            " sender_id=$sender_id, target_id=$target_id, message='$message'" );
        header( "location: messages.html" );
    }
}
?>