<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

if( isset($_POST["member_id"]) and isset($_POST["target_id"]) ) {
    create_conversation( $_POST["member_id"], $_POST["target_id"] );
}

//==========================================================================
// create_conversation
//==========================================================================
function create_conversation( $member_id, $target_id ) {
<<<<<<< HEAD
    $response = array();
=======
>>>>>>> dev-ria
    $query_string = "select count(1) as count from conversations where member_id=? and target_id=?;";
    $query_params = [$member_id, $target_id];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // PLACEHOLDER
        die( "Something went wrong" );
    }

    if( $result[0]["count"] == "1" ) {
        if( isset($_POST["member_id"]) and isset($_POST["target_id"]) ) {
<<<<<<< HEAD
            $response += array("existed" => "true");
=======
            $response = array("existed" => "true");
            echo json_encode( $response );
>>>>>>> dev-ria
        }
    }
    else {
        $query_string = "insert into conversations values (?,?) on duplicate key update member_id=member_id";
        $query_params = [$member_id, $target_id];
        $result_insert = db_query( $query_string, $query_params );

        if( $result_insert === false ) {
            // PLACEHOLDER
            die( "Something went wrong" );
        }

        if( isset($_POST["member_id"]) and isset($_POST["target_id"]) ) {
            $query_string = "select member_id as target_id,name,picture from members where member_id=?";
            $query_params = [$target_id];
            $result_response = db_query( $query_string, $query_params );

            if( $result_response  === false ) {
                // PLACEHOLDER
                die( "Something went wrong" );
            }

<<<<<<< HEAD
	    foreach( $result_response[0] as $key => $value ) {
		$response += array($key => $value);	
	    }
	    $response += array("existed" => "false");
        }
        echo json_encode( $response );
=======
            $result_response[0] += array( "existed" => "false" );
            echo json_encode( $result_response[0] );
        }
>>>>>>> dev-ria
    }
}

//==========================================================================
// load_conversations
//==========================================================================
function load_conversations( $member_id ) {
    $query_string = "select members.name,members.picture,conversations.target_id from members
        left join conversations on members.member_id=conversations.target_id where conversations.member_id=?";
    $query_params = [$member_id];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // PLACEHOLDER
        die( "Something went wrong" );
    }

    return $result;
}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> dev-ria
