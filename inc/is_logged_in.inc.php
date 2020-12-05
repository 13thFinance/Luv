<?php
require_once( "mysql.inc.php" );
require_once( "logging.inc.php" );

//==========================================================================
// is_logged_in
//   Return true if session data or cookie data can be validated.
//   Return false otherwise.
//==========================================================================
function is_logged_in() {
    session_start();
    $logged_in = false;

    // If session variables are set, user is logged in.
    if( isset($_SESSION["auth_token"]) and isset($_SESSION["member_id"]) ) {
        $logged_in = true;
    }
    // If not, confirm auth_token in cookie. If there's a match,
    // set session variables to provide invisible login.
    if( isset($_COOKIE["auth_token"]) and isset($_COOKIE["member_id"])) {
        $member_id = $_COOKIE["member_id"];

        $query_string = "select auth_token from members where member_id=?";
        $query_params = [$member_id];
        $result = db_query( $query_string, $query_params );

        if( $result ) {
            $member_data = $result[0];
            if( $member_data["auth_token"] == $_COOKIE["auth_token"] ) {
                $logged_in = true;
                $_SESSION["auth_token"] = $member_data["auth_token"];
                $_SESSION["member_id"] = $member_id;
            }
        }
    }
    return $logged_in;
}
?>