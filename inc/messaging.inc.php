<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

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
// load_messages
//==========================================================================
function load_messages( $member_id, $target_id ) {
   // we should know if someone finds a way to message themself
   if( $member_id === $target_id ) {
        LOG_ERROR( "Attempt made to load conversation with self. member_id=$member_id, target_id=$target_id" );
        die( "An error occured while loading your message history." );
    }

    // query messages from users' conversation
    $query_string = "select member_id,timestamp,content from messages" . 
        " where (member_id=? AND target_id=?) OR (member_id=? AND target_id=?) order by timestamp limit 100";
    $query_params = [$member_id, $target_id, $target_id, $member_id];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        LOG_ERROR( "Error querying messages for users. member_id=$member_id, target_id=$target_id" );
        die( "An error occured while loading your message history." );
    }

    return $result;
}
?>