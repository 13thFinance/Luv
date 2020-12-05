<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

//==========================================================================
// search_users
//   Search for members in the db who match the search val in ANY of
//   their public facing information fields, but limit to 10 hits.
//==========================================================================
function search_users( $search_val ) {

    $query_string = "select members.member_id,name,about_me,picture,avg(rating) as rating from members left join reviews on members.member_id=reviews.target_id where (name like ? or sex like ? or gender like ? or age like ? or location like ? or job_title like ? or personality like ? or looking_for like ? or about_me like ?) group by members.member_id;";
    $query_params = [];
    for( $i = 0; $i < 9; $i++)
        array_push( $query_params, "%$search_val%" );
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // error happened. do something about it.
        // die?
    }

    return $result;
}

//==========================================================================
// search_users
//   Search for members who have a complimentary personality type to
//   the user. Limit to 10 hits.
//==========================================================================
function search_recommended_users( $member_id ) {
    // get user's personality type
    $query_string = "select personality from members where member_id=?";
    $query_params = [$member_id];
    $result = db_query( $query_string, $query_params );

    if( !$result ) {
        // personality type not set...default to regular search page
        // we should probably say _something_ to the user
    }
    else {
        // get compatible personality types
        $query_string = "select match_string from personalities where type=?";
        $query_params = [$result[0]["personality"]];
        $results_pmatches = db_query( $query_string, $query_params );

        if( $results_pmatches === false ) {
            // some kind of an error?
            // die?
        }

        // query users with compatible personality types?
        $query_params = explode( ",", $results_pmatches[0]["match_string"] );
        $query_filter = implode(",", array_fill(0, count($query_params), "?"));
        array_push( $query_params, $member_id );

        $query_string = "select members.member_id,name,about_me,picture,avg(rating) as rating 
            from members left join reviews on members.member_id=reviews.target_id 
            where personality in ($query_filter) and members.member_id<>? group by members.member_id;";

        $result_recommendations = db_query( $query_string, $query_params );

        if( $result_recommendations === false )
            echo "Something went wrong";
        else
            return $result_recommendations;
    }
}
?>