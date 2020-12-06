<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

if( isset($_POST["sender_id"]) and isset($_POST["target_id"]) and isset($_POST["message"]) ) {
    send_message( $_POST["sender_id"], $_POST["target_id"], $_POST["message"] );
}

//==========================================================================
// send_messages
//==========================================================================
function send_message( $sender_id, $target_id, $message ) {

    // we should know if someone finds a way to message themself
    if( $sender_id === $target_id ) {
        LOG_ERROR( "Attempt made to send message to self. sender_id=$sender_id, target_id=$target_id" );
        return;
    }

    // send message to db with timestamp of right now
    $now = date("Y-m-d H:i:s");
    $query_string = "insert into messages values (?,?,?,?,0,0)";
    $query_params = [$sender_id, $target_id, $now, $message];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // JOSH TODO: Just refreshing for now when send fails. Not sure how else we want to handle this.
        LOG_ERROR( "Send message error -- failed to insert sent message into db." .
            " sender_id=$sender_id, target_id=$target_id, message='$message'" );
        header( "location: messages.php" );
    }
}

//==========================================================================
// load_messages
//==========================================================================
function load_messages( $member_id, $target_id ) {
    // we should know if someone finds a way to message themself
    if( $member_id === $target_id ) {
         LOG_ERROR( "Attempt made to load conversation with self. member_id=$member_id, target_id=$target_id" );
         die( "An error occured while loading your message history." );
     }
 
    // query messages from users' conversation
    $query_string = "select member_id,timestamp,content,delivered,`read` from messages" . 
        " where (member_id=? AND target_id=?) OR (member_id=? AND target_id=?) order by timestamp limit 100";
    $query_params = [$member_id, $target_id, $target_id, $member_id];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        LOG_ERROR( "Error querying messages for users. member_id=$member_id, target_id=$target_id" );
        die( "An error occured while loading your message history." );
    }

    return $result;
}

//==========================================================================
// create_conversation
//==========================================================================
function create_conversation( $member_id, $target_id ) {
    $query_string = "insert into conversations values (?,?) on duplicate key update member_id=member_id";
    $query_params = [$member_id, $target_id];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // PLACEHOLDER
        die( "Something went wrong" );
    }
}

//==========================================================================
// load_conversations
//==========================================================================
function load_conversations( $member_id ) {
    $query_string = "select members.name,members.picture,conversations.target_id from members
        left join conversations on members.member_id=conversations.target_id where conversations.member_id=?";
    $query_params = [$member_id];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // PLACEHOLDER
        die( "Something went wrong" );
    }

    return $result;
}
?>