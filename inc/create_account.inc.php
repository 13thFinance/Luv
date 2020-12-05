<?php
require_once( "mysql.inc.php" );
require_once( "logging.inc.php" );
require_once( "login.inc.php" );

if( isset($_POST["name"]) and isset($_POST["email"]) and isset($_POST["password"]) ) {
    create_account( $_POST["name"], $_POST["email"], $_POST["password"] );
}

//==========================================================================
// create_account
//==========================================================================
function create_account( $name, $email, $pwd ) {
    // hash password
    $pwd_hash = password_hash( $pwd, PASSWORD_DEFAULT );

    // find out if email address is already used
    $query_string = "select email from members where email=?";
    $query_params = [$email];
    $result_email = db_query( $query_string, $query_params );

    if( $result_email ) {
        // JOSH TODO: Change this to redirect back to the create/login page with a similar error.
        die( "PLACEHOLDER: That email address is already associated with a Luv account." );
    }

    // insert new member info into db
    $query_string = "insert into members (is_admin, email, password, name) values ('0',?,?,?)";
    $query_params = [$email, $pwd_hash, $name];
    $result_insert = db_query( $query_string, $query_params );

    if( $result_insert === false ) {
        // JOSH TODO: Change this to redirect back to the create/login page with a similar error.
        die( "PLACEHOLDER: An error occurred while creating your account." );
    }

    // create successful
    // log in user and send them to their profile page
    login( $email, $pwd );
}
?>