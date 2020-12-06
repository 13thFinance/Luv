<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

//==========================================================================
// load_reports
//   Pull all reports from db
//==========================================================================
function load_reports() {

    $query_string = "select members.name, members.picture, reports.member_id, reports.target_id, reports.timestamp, reports.content
        FROM members left join reports on reports.member_id=members.member_id;";

    $query_params = [];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // PLACEHOLDER: error handling
        die("Failed to pull reports");
    }

    return $result;
}

?>