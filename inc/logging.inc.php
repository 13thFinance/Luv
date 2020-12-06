<?php
define( "LOGS_PATH", $_SERVER["DOCUMENT_ROOT"] . "/luv/logs/" );

// Log messages are sent to their respective type of file (error or debug).
// A new log file for each type is generated daily, named like:
// "2020-11-30_error".

//==========================================================================
// LOG_ERROR
//   Logging for critical errors for information
//   that shouldn't be displayed to the user.
//==========================================================================
function LOG_ERROR( $message ) {
    // make sure img/profile path exists
    if( !file_exists( LOGS_PATH ) ) {
        mkdir( LOGS_PATH, 0775, true );
    }

    $filename = LOGS_PATH . date("Y-m-d") . "_error";
    $msg_body = date("H:i:s") . ": " . $message . "\n";
    $f = fopen($filename, "a") or die();
    fwrite($f, $msg_body);
    fclose($f);
}

//==========================================================================
// LOG_DEBUG
//   Logging for development purposes only.
//==========================================================================
function LOG_DEBUG( $message ) {
    $filename = LOGS_PATH . date("Y-m-d") . "_debug";
    $msg_body = date("H:i:s") . ": " . $message . "\n";
    $f = fopen($filename, "a") or die();
    fwrite($f, $msg_body);
    fclose($f);
}
?>