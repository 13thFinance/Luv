<?php
require_once("inc/mysql.inc.php");
require_once("inc/logging.inc.php");

//==================================================================================
// new_method - to add the match in the database
// get_match - to see what match the user has got.
// if_matched - to know if both the members clicked match on each other
//===================================================================================

<<<<<<< HEAD
function new_match(member_id, target_id){
=======
function new_match($member_id, $target_id){
>>>>>>> ea2d7760f779ef82110aee61f472209509307636
    $query_string="insert into matches(member_id , target_id) values (?,?)"
    $query_params=[$member_id, $target_id];
    $result = db_query($query_string, $query_params);

if( $result === false)
    die("something went wrong");
}

function get_match($member_id, $target_id){
<<<<<<< HEAD
    $query_string="select from matches where (member_id= ? AND target_id=?)"
=======
    //returns an int, number of matches made from member_id to target_id
    
    $query_string="select * from matches where (member_id= ? AND target_id=?)"
>>>>>>> ea2d7760f779ef82110aee61f472209509307636
    $query_params=[member_id, $target_id];
    $result = db_query($query_string, $query_params);

    if($result === false){
        LOG_ERROR("Error quering matches from users")
        die("No matches were found")
    }
<<<<<<< HEAD
=======
    
>>>>>>> ea2d7760f779ef82110aee61f472209509307636
    return $result; // here i got my match (target_id)
}

function if_matched($member_id, $target_id){
<<<<<<< HEAD
=======
    //returns true if both members matched
>>>>>>> ea2d7760f779ef82110aee61f472209509307636
    $query_string = "select count(1) from matches where (member_id=? AND target_id=?) OR (member_id=? AND target_id=?)";
    $query_params = [$member_id, $target_id, $target_id, $member_id];
    $result = db_query( $query_string, $query_params );

    if($result === false){
        LOG_ERROR("Error quering matches from users")
        die("No matches were found")
    }
<<<<<<< HEAD
=======
    
>>>>>>> ea2d7760f779ef82110aee61f472209509307636
    return $result[0] == "2"; 
}
?>
