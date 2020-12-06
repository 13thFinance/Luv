<?php
require_once( "inc/is_logged_in.inc.php" );
require_once( "inc/mysql.inc.php" );
require_once( "inc/logging.inc.php" );

$users_name = "";
$personality = "";
$about_me_text = "";
$sex = "";
$gender = NULL;
$age = 0;
$looking_for = "";
$job_title = "";
$location = "";
$picture = "";
$member_id = "";
$target_id = "";
if( is_logged_in() ) {
    if( isset($_POST["target_id"]) ){
        $member_id = $_SESSION["member_id"];
        $target_id = $_POST["target_id"];
    }
    else {
        // PLACEHOLDER: Remove once search page view button posts target_id
        $member_id = $_SESSION["member_id"];
        $target_id = "21";
    }

    $query_string = "SELECT name, personality, about_me, sex, gender, age, looking_for, job_title, location, picture FROM members WHERE member_id=?";
    $query_params = [$target_id];
    $query_result = db_query($query_string, $query_params);

    if( $query_result === false ){
        // Error handling
    }
    else{
        $users_name = $query_result[0]["name"];
        $personality = $query_result[0]["personality"];
        $about_me_text = $query_result[0]["about_me"];
        $sex = $query_result[0]["sex"];
        $gender = $query_result[0]["gender"];
        $age = $query_result[0]["age"];
        $looking_for = $query_result[0]["looking_for"];
        $job_title = $query_result[0]["job_title"];
        $location = $query_result[0]["location"];
        $picture = $query_result[0]["picture"];
    }
}
else
    header( "location: /luv/createAccountBody.html" );
?>

<!DOCTYPE html>

<html lang = "en">

    <head>
        <title> Account Management </title>
        <meta charset = "utf-8"/>
        <link rel = "stylesheet" href = "main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="form-functions.js"></script>
        
    </head>
    <body class="landing-page">
        <div class="navbar">
            <div id="nav-placeholder"></div>

            <!-- fix this up later, move to main.js -->
            <script>
                $(function(){
                  $("#nav-placeholder").load("modules/nav.html");
                });
            </script>
        </div>
        
            <div id = "main-div-view-other">
                <div id="profile-body-div-left-readonly">
                    <form id = "view-other-form" action="URL">
                        <div id = "profile-pic-div-readonly">    
                            <img src="profilepic.png" id = "profile-pic-readonly" alt="None">
                        </div>
                        
                        <div id="name-personality-pair-read-only">
                             <div id="user-name-read-only">
                                <div class = "frameBodyAccountManagement">  
                                    <div class = "frameTitleAccountManagement"> Name </div>
                                    <input type = "text" id = "nameBoxInput-read-only" placeholder="Input Name" value="<?php echo $users_name ?>">
                                </div>
                            </div>

                            <div id="user-personality-read-only">
                                <div class = "frameBodyAccountManagement">  
                                    <div class = "frameTitleAccountManagement"> Personality </div>
                                    <input type = "text" id = "personalityBoxInput-read-only" placeholder="Input Personality" value="<?php echo $personality ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div id="about-me-div-readonly">
                            <div id = "about-me-body-readonly">
                                <div id = "about-me-title-readonly"> About Me</div>
                                <textarea id = "about-me-input-readonly" name = "aboutMeInfo" rows = "12" cols = "60" style="resize: none" disabled>
                                    <?php echo "$about_me_text"; ?>
                                </textarea>
                            </div>
                        </div>
                        <div id = "sex-gender-div-readonly">
                            <div class = "frameBodyAccountManagement">  
                                <div class = "frameTitleAccountManagement"> Sex </div>
                                <input type = "text" name = "sexPreferenceInput" id = "sex-box-input-readonly" placeholder="Input Sex Preference" value="<?php echo $sex ?>" disabled>
                            </div>
                            <div class = "frameBodyAccountManagement">  
                                <div class = "frameTitleAccountManagement"> Gender </div>
                                <select name = "Gender" id = "gender-selection-menu-readonly" value="<?php echo $gender ?>" disabled>
                                <option> Select Gender </option>
                                <option> Male </option>
                                <option> Female </option>
                                <option> Other </option>
                            </select>
                            </div>
                        </div>
                        <div id = "age-looking-for-div-readonly">
                            <div class = "frameBodyAccountManagement">  
                                <div class = "frameTitleAccountManagement"> Age </div>
                                <input type = "text" name = "ageInput" id = "age-box-input-readonly" placeholder="Input Age" value="<?php echo $age ?>" disabled>
                            </div>
                            <div class = "frameBodyAccountManagement">  
                                <div class = "frameTitleAccountManagement"> Looking For </div>
                                <input type = "text" name = "lookingForInput" id = "looking-for-box-input-readonly" placeholder="Looking for..." value="<?php echo $looking_for ?>" disabled>
                            </div>
                        </div>
                        <div id="job-title-div-readonly">
                            <div class = "frameBodyAccountManagement">  
                                <div class = "frameTitleAccountManagement"> Job Title </div>
                                <input type = "text" name = "jobTitleInput" id = "job-title-box-input-readonly" placeholder="Input Job Title" value="<?php echo $job_title ?>" disabled>
                            </div>
                        </div>
                        <div id="location-div-readonly">
                            <div class = "frameBodyAccountManagement">  
                                <div class = "frameTitleAccountManagement"> Location </div>
                                <input type = "text" name = "locationInput" id = "location-box-input-readonly" placeholder="Where are you from?" value="<?php echo $location ?>" disabled>
                            </div>
                        </div>
                        
                        
                        <div class="report-account-button-div">
                            <input type="button" id="report-account-button" value="Report Account"/>
                        </div>
                        
                        
                    </form>
                </div> <!--Left Profile Div -->
                <div class="vertical-line-div2"></div>
                <div id = "reviews-account-management-right-readonly">
                    <div class="reviews-space-div"> </div>
                    <div id = "reviews-label-div-readonly">
                        <label id = "reviews-label-readonly">
                            Reviews
                        </label>    
                    </div>
                    
                    <div class = "reviews-label-div-readonly">
                        <input type="button" id="add-review-button" class="add-review-button-class" value="Add Review"/>   
                    </div>
                    
                    <div class = "scrollable">
                    
                        <div class="review-parent-div">
                            <div class="review-image-div">
                                <img src="profilepic.png" class = "reviewProfilePic" alt="None">
                                <label id="review-label-1" class="profile-review-name-label-class">
                                Profile Name Here
                                </label>
                            </div>

                            <div class="review-feedback-div">

                                <textarea id="review-textarea-id1" readonly class="review-text-area" rows=5 cols=105 style="resize: none"></textarea>

                                <hr/>


                                <div class="review-stars-div">
                                    <form action="URL" id="form-review-1" class="review-rating-form">
                                        <fieldset>
                                            <input type="radio" name="review-rating" id="review-rating-id1-1-readonly" class="review-rating-id" value="rating">
                                            <label for="review-rating-id1-1-readonly" class="rating-start-label">1 Star</label>

                                            <input type="radio" name="review-rating" id="review-rating-id2-1-readonly" class="review-rating-id" value="rating">
                                            <label for="review-rating-id2-1-readonly" class="rating-start-label">2 Stars</label>

                                            <input type="radio" name="review-rating" id="review-rating-id3-1-readonly" class="review-rating-id" value="rating">
                                            <label for="review-rating-id3-1-readonly" class="rating-start-label">3 Stars</label>

                                            <input type="radio" name="review-rating" id="review-rating-id4-1-readonly" class="review-rating-id" value="rating">
                                            <label for="review-rating-id4-1-readonly" class="rating-start-label">4 Stars</label>

                                            <input type="radio" name="review-rating" id="review-rating-id5-1-readonly" class="review-rating-id" value="rating">
                                            <label for="review-rating-id5-1-readonly" class="rating-start-label">5 Stars</label>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div> <!--Reviews Account Management Right -->
            </div> <!--Main Div -->
        <script type="text/javascript" src="form-event-handler.js"></script>
    </body>
</html>