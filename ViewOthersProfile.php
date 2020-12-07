<?php
require_once( "inc/is_logged_in.inc.php" );
require_once( "inc/mysql.inc.php" );
require_once( "inc/logging.inc.php" );
require_once( "inc/reviews.inc.php" );
require_once( "inc/reports.inc.php" );
require_once( "inc/get_match_state.inc.php" );

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
$report_params = "";
$review_params = "";
$disable_report_button = "true";
$disable_review_button = "true";
if( is_logged_in() ) {
    if( isset($_POST["target_id"]) ){
        $member_id = $_SESSION["member_id"];
        $target_id = $_POST["target_id"];

        // Only show Add Review button if these users have matched and
        // this user hasn't already left a review for the target user
        $match_state = json_decode( get_match_state($member_id, $target_id), true );
        if( $match_state["member_match"] == "true" and $match_state["target_match"] == "true" ) {
            if( !has_reviewed($member_id, $target_id) ) {
                $review_params ="'$member_id', '$target_id'";
                $disable_review_button ="false";
            }
        }

        // Only show Report User button if this user hasn't already
        // reported the target user.
        if( !has_reported($member_id, $target_id) ) {
            $report_params = "'$member_id', '$target_id'";
            $disable_report_button = "false";
        }
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

    $reviews = load_reviews($target_id);
}
else
    header( "location: /luv/createAccountBody.php" );
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
                            <img src="<?php echo $picture ?>" id = "profile-pic-readonly" alt="None">
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
                                <textarea id = "about-me-input-readonly" name = "aboutMeInfo" rows = "12" cols = "60" style="resize: none" disabled><?php echo "$about_me_text"; ?></textarea>
                            </div>
                        </div>
                        <div id = "sex-gender-div-readonly">
                            <div class = "frameBodyAccountManagement">  
                                <div class = "frameTitleAccountManagement"> Sex </div>
                                <input type = "text" name = "sexPreferenceInput" id = "sex-box-input-readonly" placeholder="Input Sex Preference" value="<?php echo $sex ?>" disabled>
                            </div>
                            <div class = "frameBodyAccountManagement">  
                                <div class = "frameTitleAccountManagement"> Gender </div>
                                <input type = "text" name = "Gender" id = "gender-selection-menu-readonly" placeholder="gender" value="<?php echo ucfirst($gender) ?>" disabled>
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
                            <input type="button" id="report-account-button" value="Report Account" onclick="fnReportAction(<?php echo $report_params; ?>)"/>
                        </div>
                    </form>
                    <script>
                        var disabled = <?php echo $disable_report_button; ?>;
                        if( disabled == true ) {
                            document.getElementById( "report-account-button" ).remove();
                        }
                    </script>
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
                        <input type="button" id="add-review-button" class="add-review-button-class" value="Add Review" onclick="fnReviewAction(<?php echo $review_params; ?>)"/>   
                    </div>

                    <script>
                        var disabled = <?php echo $disable_review_button; ?>;
                        if( disabled == true ) {
                            document.getElementById( "add-review-button" ).remove();
                        }
                    </script>
                    
                    <div id ="review-wrapper" class = "scrollable">
                        
                        
                    </div>
                    
                    <script>
                        var reviews_results = <?php echo json_encode($reviews); ?>;
                        reviews_results.forEach( review => {
                            var name = review.name;
                            var picture = review.picture;
                            var rating = review.rating;
                            var content = review.content;
                            
                            var review_parent_div = document.createElement( "DIV" );
                            var review_image_div = document.createElement( "DIV" );
                            var image_div = document.createElement("DIV");
                            var profile_image_source = document.createElement( "IMG" );
                            var username_div = document.createElement("DIV");
                            var username_p = document.createElement( "P" );
                            var feedback_div = document.createElement( "DIV" );
                            var review_textarea = document.createElement( "TEXTAREA" );
                            var hline_hr = document.createElement("HR");
                            var review_stars_div = document.createElement( "DIV" );

                            review_parent_div.classList.add("review-parent-div");
                            review_image_div.classList.add("review-image-div");
                            profile_image_source.classList.add("reviewProfilePic");
                            username_p.classList.add("review-profile-pic-name");
                            feedback_div.classList.add("review-feedback-div");
                            review_textarea.classList.add("review-text-area");
                            review_stars_div.classList.add("review-stars-flex-div");

                            review_textarea.rows = "5";
                            review_textarea.cols = "105";
                            review_textarea.style.resize = "none";
                            review_textarea.innerHTML = content;
                            profile_image_source.src = picture;
                            profile_image_source.alt = "img/profile/default.png";
                            username_p.innerHTML = name;


                            // add more hearts per rating
                            var i;
                            for (i = 1; i <= rating; i++) {

                                var stars_div = document.createElement( "DIV" );
                                var stars_image = document.createElement( "IMG" );

                                stars_div.classList.add("review-stars-div");
                                stars_image.src = "img/rating/rating.png";
                                stars_image.alt = "<3";
                                stars_div.appendChild(stars_image);

                                review_stars_div.appendChild(stars_div);
                            }

                            feedback_div.appendChild(review_textarea);
                            feedback_div.appendChild(hline_hr);
                            feedback_div.appendChild(review_stars_div);

                            image_div.appendChild(profile_image_source);
                            username_div.appendChild(username_p);

                            review_image_div.appendChild(image_div);
                            review_image_div.appendChild(username_div);

                            review_parent_div.appendChild(review_image_div);
                            review_parent_div.appendChild(feedback_div);

                            document.getElementById( "review-wrapper" ).appendChild(review_parent_div);
                            
                        
                        });
                    </script>
                        
                </div> <!--Reviews Account Management Right -->
            </div> <!--Main Div -->
        <script type="text/javascript" src="form-event-handler.js"></script>
    </body>
</html>