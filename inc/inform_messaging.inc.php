<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

// start with a clean output buffer
ob_end_clean();

// make sure the script doesn't timeout
set_time_limit( 0 );
ini_set('max_execution_time', '0');

// necessary header content for server-side events
header( "Content-Type: text/event-stream" );
header( "Cache-Control: no-cache" );

// get list of undelivered messages from db
$query_string = "select * from messages where delivered=? order by timestamp asc";
$query_params = ["0"];
$results = db_query( $query_string, $query_params );

if( $results  ) {
    foreach( $results as $msg ) {
        // deliver each message as server-side event
        echo "data: ".json_encode($msg)."\n";
        echo "retry: 1000\n\n";
        ob_flush();
        flush();

        // update message: delivered
        $query_string = "update messages set delivered=? where member_id=? and target_id=? and timestamp=?";
        $query_params = ["1", $msg["member_id"], $msg["target_id"], $msg["timestamp"]];
        db_query( $query_string, $query_params );
    }
}
?>