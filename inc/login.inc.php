<?php
require_once( "mysq.inc.php" );
require_once( "logging.inc.php" );

if( isset($_POST["login-email"]) and isset($_POST["login-password"]) ) {
    login( $_POST["login-email"], $_POST["login-password"] );
}

//==========================================================================
// login
//==========================================================================
function login( $email, $pwd ) {
    // retrieve member info from db
    $query_string = "select email,member_id, password from members where email=?";
    $query_params = [$email];
    $result = db_query( $query_string, $query_params );

    $invalid_login = false; 

    // if invalid email (no query results)
    if( !$result ) {
        $invalid_login = true;
    }

    // if invalid password
    if( !isset($result[0]["password"]) or !password_verify($pwd, $result[0]["password"]) ) {
        $invalid_login = true;
    }

    // inform user of invalid credentials one way or the other
    if( $invalid_login ) {
        // JOSH TODO: Change this to redirect back to the create/login page with a similar error.
        die( "PLACEHOLDER: Invalid email/password." );
    }

    // calculate auth_token and get member_id
    $auth_token = md5( random_bytes(16) );
    $member_id = $result[0]["member_id"];

    // set an auth_token for the member in the db
    $query_string = "update members set auth_token=? where member_id=?";
    $query_params = [$auth_token, $member_id];
    $result = db_query( $query_string, $query_params );

    if( !$result ) {
        // JOSH TODO: Change this to redirect back to the create/login page with a similar error.
        LOG_ERROR( "Login error -- failed to update auth_token, member_id='$member_id'" );
        die( "PLACEHOLDER: Something went wrong while logging in." );
    }

    // start the session and populate session data
    session_start();
    $_SESSION["member_id"] = $member_id;
    $_SESSION["auth_token"] = $auth_token;

    // cookie expires in 30 days (now + seconds in an hour * hours in a day * 30)
    $expiry_time = time()+3600*24*30;
    setcookie( "auth_token", $auth_token, $expiry_time, "/luv" );
    setcookie( "member_id", $member_id, $expiry_time, "/luv");

    // redirect to user's profile
    header( "location: ../accountManagement.html" );
}