<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

if( isset($_POST["submit_delete"]) and isset($_POST["member_id"]) ){
    deleteAccount( $_POST["member_id"] );
}
else if( isset($_POST["submit_ignore"]) and isset($_POST["member_id"]) and 
        isset($_POST["target_id"]) and isset($_POST["timestamp"]) ) {
    ignoreAccount( $_POST["member_id"], $_POST["target_id"], $_POST["timestamp"] );
}

//==========================================================================
// load_reports
//   Pull all reports from db
//==========================================================================
function load_reports() {

    $query_string = "select members.name, members.picture, reports.member_id, reports.target_id, reports.timestamp, reports.content
        FROM reports left join members on reports.target_id=members.member_id";

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
//   Deletes reported user from db (removing all associated data through a
//   delete cascade in db)
//==========================================================================
function deleteAccount( $member_id ) {
    $query_string = "DELETE FROM members where member_id=?";
    $query_params = [$member_id];
    $result = db_query( $query_string, $query_params );
}

//==========================================================================
// ignoreAccount
//   Removed the report from the db and nothing else
//==========================================================================
function ignoreAccount( $member_id, $target_id, $timestamp ) {

    $query_string = "DELETE FROM reports WHERE member_id=? and target_id=? and timestamp=?;";
    $query_params = [$member_id, $target_id, $timestamp];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // PLACEHOLDER: Error handle reports
        die( "Something went wrong with deleteing report" );
    }
}

?>