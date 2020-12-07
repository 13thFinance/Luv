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
        LOG_DEBUG( "we know it exists" );
        // JOSH TODO: Change this to redirect back to the create/login page with a similar error.
        session_start();
        $_SESSION["account_exists_error"] = true;
        header( "location: /luv/createAccountBody.php" );
        return;
    }

    // insert new member info into db
    $img = "img/profile/default.png";
    $query_string = "insert into members (is_admin, email, password, name, picture) values ('0',?,?,?,?)";
    $query_params = [$email, $pwd_hash, $name, $img];
    $result_insert = db_query( $query_string, $query_params );

    // create successful
    // log in user and send them to their profile page
    login( $email, $pwd );
}
?>