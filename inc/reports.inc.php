<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

if( isset($_POST["delete_id"]) ){
    deleteAccount( $_POST["delete_id"] );
}
else if ( isset($_POST["reporter_id"]) and isset($_POST["ignore_id"])) and isset($_POST["report_timestamp"] ) {
    ignoreAccount( $_POST["reporter_id"], $_POST["ignore_id"], $_POST["report_timestamp"] );
}

//==========================================================================
// load_reports
//   Pull all reports from db
//==========================================================================
function load_reports() {

    $query_string = "select members.name, members.picture, reports.member_id, reports.target_id, reports.timestamp, reports.content
        FROM reports left join members on reports.target_id=members.member_id;";

    $query_params = [];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // PLACEHOLDER: error handling
        die("Failed to pull reports");
    }

    return $result;
}

//==========================================================================
// deleteAccount
//   Removed all reports associate with the member_id, deletes their account
//   information, reviews, matches and conversations.
//==========================================================================
function deleteAccount( $member_id ) {
    
    $query_string = "DELETE FROM reports INNER JOIN members ON reports.target_id = members.member_id
        INNER JOIN reviews ON reports.target_id = reviews.member_id AND reports.target_id = reviews.targer_id
        INNER JOIN matches ON reports.target_id = matches.member_id AND reports.target_id = matches.target_id
        WHERE reports.target_id=?";
    $query_params = [$member_id];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // PLACEHOLDER: Error handle reports
        die( "Something went wrong with deleteing report" );
    }
}

//==========================================================================
// ignoreAccount
//   Removed the report from the db and nothing else
//==========================================================================
function ignoreAccount( $member_id, $target_id, $timestamp ) {

    $query_string = "DELETE FROM reports WHERE member_id=? and target_id=? and timestamp=?";
    $query_params = [$member_id, $target_id, $timestamp];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // PLACEHOLDER: Error handle reports
        die( "Something went wrong with deleteing report" );
    }
}

?>