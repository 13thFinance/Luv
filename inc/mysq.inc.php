<?php
require_once( "logging.inc.php" );

define( "DB_HOST", "localhost" );
define( "DB_USER", "group1" );
define( "DB_PASSWORD", "akWVE1W7v7JM" );
define( "DB_NAME", "group1" );

static $last_insert_id = NULL;

//==========================================================================
// db_open
//==========================================================================
function db_open() {
    $cnx = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
    if( !$cnx ) {
        log_error( "Could not connect to mysql db -- " . mysqli_connect_error() );
        die( "An error occurred. Please contact the site administrator if this problem persists." );
    }
    return $cnx;
}

//==========================================================================
// db_close
//==========================================================================
function db_close( $cnx ) {
    if(  $cnx  )
        mysqli_close( $cnx );
}
?>