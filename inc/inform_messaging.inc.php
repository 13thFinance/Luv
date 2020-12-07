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
$query_string = "select * from messages where delivered=? or `read`=? order by timestamp asc";
$query_params = ["0","0"];
$results = db_query( $query_string, $query_params );

if( $results  ) {
    foreach( $results as $msg ) {
        // deliver each message as server-side event
        echo "event: message\n";
        echo "data: ".json_encode($msg)."\n\n";
    }
}

$query_string = "select a.member_id as member_id,a.target_id as target_id, a.delivered as delivered 
    from matches as a, matches as b where a.member_id=b.target_id and a.target_id=b.member_id";
$result_matches = db_query( $query_string, [] );

if( $result_matches ) {
    foreach( $result_matches as $match ) {
        if( $match["delivered"] == "0" ) {
            // deliver each match as server-side event
            echo "event: match\n";
            echo "data: ".json_encode($match)."\n\n";
        }
    }
}

echo "retry: 1000\n\n";
ob_flush();
flush();
?>
