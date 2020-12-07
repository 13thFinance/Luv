<?php
require_once("inc/mysql.inc.php");
require_once("inc/logging.inc.php");

//create a report
function new_report($member_id, $target_id, $complaint){
    $now = date("Y-m-d H:i:s");
    $query_string="insert into report(member_id, target_id, timestamp, content)" values (?,?,?,?);
    $query_params = [$member_id, $target_id, $now, $complaint];
    $result = db_query( $query_string, $query_params );
}

