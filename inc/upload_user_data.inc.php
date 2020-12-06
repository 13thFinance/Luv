<?php
require_once( "is_logged_in.inc.php" );
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

if( is_logged_in() ) {
    LOG_DEBUG("gender: " . $_POST["genderSelectionMenu"]);
    $session_start;
    $member_id = $_SESSION["member_id"];
    if( isset($_POST["nameBoxInput"]) and isset($_POST["personalityBoxInput"]) and isset($_POST["aboutMeInput"]) and
        isset($_POST["sexBoxInput"]) and isset($_POST["genderSelectionMenu"]) and isset($_POST["ageBoxInput"]) and
        isset($_POST["lookingForBoxInput"]) and isset($_POST["jobTitleBoxInput"]) and isset($_POST["locationBoxInput"]) ) {
        upload_user_data( $_POST["nameBoxInput"], $_POST["personalityBoxInput"], $_POST["aboutMeInput"], 
            $_POST["sexBoxInput"], $_POST["genderSelectionMenu"], $_POST["ageBoxInput"], $_POST["lookingForBoxInput"], 
            $_POST["jobTitleBoxInput"], $_POST["locationBoxInput"], $member_id);
        }
}

function upload_user_data( $users_name, $personality, $about_me_text, $sex, 
    $gender, $age, $looking_for, $job_title, $location, $member_id ) {

    // Update all user data fields in database
    $query_string = "UPDATE members SET name=?, personality=?, about_me=?, sex=?, gender=?, age=?, looking_for=?, job_title=?, location=? WHERE member_id=?";
    $query_params = [$users_name, $personality, $about_me_text, $sex, $gender, $age, $looking_for, $job_title, $location, $member_id];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // failed to update user information
        // PLACEHOLDER -- Need to inform the user
        LOG_ERROR( "Send message error -- failed to update member data into db." .
            " member_id=$member_id" );
        header( "location: ../accountManagement.php" );
    }

    header( "location: ../accountManagement.php" );
}



?>