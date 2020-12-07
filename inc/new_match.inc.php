<?php
require_once("logging.inc.php");
require_once("mysql.inc.php");

if( isset($_POST["member_id"]) and isset($_POST["target_id"]) ) {
    new_match( $_POST["member_id"], $_POST["target_id"] );
}

function new_match($member_id, $target_id){
    $query_string = "insert into matches values (?,?)";
    $query_params = [$member_id, $target_id];
    $result = db_query($query_string, $query_params);
}
?>