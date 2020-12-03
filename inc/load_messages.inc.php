<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

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