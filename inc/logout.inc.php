<?php
require_once( "mysql.inc.php" );
require_once( "logging.inc.php" );

//==========================================================================
// logout
//==========================================================================
function logout() {
    // The session data should still exist here, but if something went
    // wrong and it doesn't, we can still clear the persistent cookies
    // and bring them back to the landing page. User experience isn't
    // impacted at all.
    session_start();
    if( isset($_SESSION["member_id"]) ) {
        $member_id = $_SESSION["member_id"];

        // nullify the user's auth_token in the db
        $query_string = "update members set auth_token=NULL where member_id=?";
        $query_params = [$member_id];
        $result = db_query( $query_string, $query_params );

        if( !$result ) {
            // JOSH TODO: Change this to redirect back to the create/login page with a similar error.
            LOG_ERROR( "Logoutin error -- failed to nullify auth_token, member_id=$member_id" );
            die( "PLACEHOLDER: Something went wrong while logging out." );
        }

        // unset session variables
        unset( $_SESSION["auth_token"] );
        unset( $_SESSION["member_id"] );
    }

    // invalidate the user's cookies by setting expired time
    $expiry_time = time()-3600;
    setcookie( "auth_token", "", $expiry_time, "/luv" );
    setcookie( "member_id", "", $expiry_time, "/luv" );
    
    // redirect to title page
    header( "location: /luv" );
}
?>