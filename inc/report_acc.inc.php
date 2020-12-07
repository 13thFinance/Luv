<?php
require_once("mysql.inc.php");
require_once("logging.inc.php");

if( isset($_POST["member_id"]) and isset($_POST["target_id"]) and isset($_POST["content"]) ) {
    new_report( $_POST["member_id"], $_POST["target_id"], $_POST["content"] );
}
function new_report($member_id, $target_id, $content){
    $now = date("Y-m-d H:i:s");
    $query_string="insert into reports (member_id, target_id, timestamp, content) values (?,?,?,?)";
    $query_params = [$member_id, $target_id, $now, $content];
    $result = db_query( $query_string, $query_params );
}