<?php
require_once( "logging.inc.php" );
require_once( "mysql.inc.php" );

//if( isset($_POST["member_id"]) ) {
    upload_user_data( $_POST["nameBoxInput"], $_POST["personalityBoxInput"], $_POST["aboutMeInput"], $_POST["sexBoxInput"], $_POST["genderSelectionMenu"], $_POST["ageBoxInput"], $_POST["lookingForBoxInput"], $_POST["jobTitleBoxInput"], $_POST["locationBoxInput"], $_SESSION["member_id"]);
//}

function upload_user_data( $users_name, $personality, $about_me_text, $sex, $gender, $age, $looking_for, $job_title, $location, $member_id ) {

    // Update all user data fields in database
    $query_string = "UPDATE members SET name=?, personality=?, about_me=?, sex=?, gender=?, age=?, looking_for=?, job_title=?, location=? WHERE member_id=?";
    $query_params = [$users_name, $personality, $about_me_text, $sex, $gender, $age, $looking_for, $job_title, $location, $member_id];
    $result = db_query( $query_string, $query_params );

    if( $result === false ) {
        // failed to update user information
        LOG_ERROR( "Send message error -- failed to update member data into db." .
            " member_id=$member_id" );
        header( "location: ../accountManagement.php" );
    }
    else{
        echo '<script>alert("Successfully updated user information")</script>'; 
    }

    header( "location: ../accountManagement.php" );
}



?>