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

//==========================================================================
// db_query
//   Run a fully prepared mysqli query from start to finish.
//     Returns result set (even empty set) if query was SELECT type.
//     Returns TRUE if INSERT/UPDATE/DELETE query succeeded.
//     Returns FALSE if query operation failed for any reason.
//   result_type is optional and returns associative array if not assigned.
//   Other result_type options are MYSQLI_NUM and MYSQLI_BOTH.
//==========================================================================
function db_query( $query_string, $param_array=NULL, $result_type = MYSQLI_ASSOC ) {
    // validate input
    if( strlen($query_string) == 0 ) {
        LOG_ERROR( "mysqli query attempted with empty query string" );
        die( "An error occurred. Please contact the site administrator if this problem persists." );
    }

    // open connection to db
    $cnx = db_open();
    $result;

    if( !$param_array ) {
        $result = mysqli_query( $cnx, $query_string );
    }
    else {
        // prepare query statment
        $types = str_repeat( "s", count($param_array) );
        $stmt = mysqli_prepare( $cnx, $query_string );
        if( !$stmt ) {
            LOG_ERROR( "Failed to build prepared statment while running mysqli query. Check for syntax errors in query string.\n'$query_string' ");
            die( "An error occurred. Please contact the site administrator if this problem persists." );
        }
        mysqli_stmt_bind_param( $stmt, $types, ...$param_array );

        // execute query
        mysqli_stmt_execute( $stmt );
        $result = mysqli_stmt_get_result( $stmt );
    }

    // validate query results
    $return_value = false;

    // If this was a successful insert/update/delete
    // query, result == false but errno == 0.
    // In that case, return true to show that it succeeded.
    if( !$result and mysqli_errno($cnx) === 0) {
        $return_value = true;
    }
    // Otherwise, this was a select statement.
    // Return the results.
    else if( $result ) {
        $return_value = mysqli_fetch_all( $result, $result_type );
    }
    
    // Let errors fall through. The caller is capable of
    // logging more detailed information about the error
    // and can respond to it in ways other than "die".
    /*
    else {
        LOG_ERROR( "mysqli query failed with errorcode: " . mysqli_errno($cnx) );
        die( "An error occurred. Please contact the site administrator if this problem persists." );
    }
    */

    // close connection to db
    db_close( $cnx );

    return $return_value;
}
?>