<?php
require_once( "inc/is_logged_in.inc.php" );
require_once( "inc/mysql.inc.php" );

$users_name = "";
//$personality = "";
$about_me_text = "";
$sex = "";
$gender = "";
$age = 0;
$looking_for = "";
$job_title = "";
$location = "";
$picture = "";
if( is_logged_in() ) {
    $about_me_text = "YOU'RE SUPER LOGGED IN";
    $session_start;
    $member_id = $_SESSION["member_id"];

    $query_string = "SELECT name, about_me, sex, gender, age, looking_for, job_title, location, picture FROM members WHERE member_id=?";
    $query_params = [$member_id];
    $query_result = db_query($query_string, $query_params);

    if( $query_result === false ){
        $users_name = [0]["name"];
        //$personality = [0][""];
        $about_me_text = [0]["about_me"];
        $sex = [0]["sex"];
        $gender = [0]["gender"];
        $age = [0]["age"];
        $looking_for = [0]["looking_for"];
        $job_title = [0]["job_title"];
        $location = [0]["location"];
        $picture = [0]["picture"];
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
        
        <div id = "mainDivAccountManagement">
            <div id="profileBodyDiv-Left">
                
                <form id = "accountManagementForm" action="URL">
                    <div id = "profilePicDiv">    
                        <img src="profilepic.png" id = "profilePic" alt="ppic">
                    </div>
                    
                    <div id="name-personality-pair">
                         <div id="userName">
                            <div class = "frameBodyAccountManagement">  
                                <div class = "frameTitleAccountManagement"> Name </div>
                                <input type = "text" id = "nameBoxInput" placeholder="Input Name" value="<?php echo $users_name ?>">
                            </div>
                        </div>

                        <div id="userPersonality">
                            <div class = "frameBodyAccountManagement">  
                                <div class = "frameTitleAccountManagement"> Personality </div>
                                <input type = "text" id = "personalityBoxInput" placeholder="Input Personality">
                            </div>
                        </div>
                    </div>
                    
                    <div id="aboutMeDiv">
                        <div id = "aboutMeBody">
                            <div id = "aboutMeTitle"> About Me</div>
                            <textarea id = "aboutMeInput" rows = "12" cols = "60" style="resize: none"><?php echo "$about_me_text"; ?></textarea>
                        </div>
                    </div>
                    
                    <div id = "sexGenderDiv">
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Sex </div>
                            <input type = "text" id = "sexBoxInput" placeholder="Input Sex Preference"  value="<?php echo $sex ?>">
                        </div>
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Gender </div>
                            <select id = "genderSelectionMenu">
                            <option> Select Gender </option>
                            <option> Male </option>
                            <option> Female </option>
                            <option> Other </option>
                        </select>
                        </div>
                    </div>
                    
                    <div id = "ageLookingForDiv">
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Age </div>
                            <input type = "text" id = "ageBoxInput" placeholder="Input Age"  value="<?php echo $age ?>">
                        </div>
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Looking For </div>
                            <input type = "text" id = "lookingForBoxInput" placeholder="Looking for..."  value="<?php echo $looking_for ?>">
                        </div>
                    </div>
                    <div id="jobTitleDiv">
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Job Title </div>
                            <input type = "text" id = "jobTitleBoxInput" placeholder="Input Job Title"  value="<?php echo $job_title ?>">
                        </div>
                    </div>
                    <div id="locationDiv">
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Location </div>
                            <input type = "text" id = "locationBoxInput" placeholder="Where are you from?" value="<?php echo $location ?>">
                        </div>
                    </div>
                    <div id="saveChangesDiv">
                        <button id = "saveChangesButton" type="submit" name="submit-save">Save Changes</button>
                    </div>
                </form>
                <form id = "accountSignOutForm" action="inc/logout.inc.php" method="post">
                    <!-- sign out -->
                    <div id="sign-out-div">
                        <button id = "sign-out-button" type="submit" name="submit-signout">Sign Out</button>
                    </div>
                </form>
            </div> <!--Left Profile Div -->
            
            <div class="vertical-line-div2"></div>
            
            <div id = "reviewsAccountManagement-Right">
                <div class="reviews-space-div"> </div>
                <div id = "reviewsLabelDiv">
                    <label id = "reviewsLabel">
                        Reviews
                    </label>    
                </div>

                <div class="review-parent-div">
                    <div class="review-image-div">
                        <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                    </div>

                    <div class="review-feedback-div">

                        <textarea readonly class="review-text-area" rows=5 cols=105 style="resize: none"></textarea>

                        <hr/>
                        
                        <div class="review-stars-div">
                            <form action="URL" class="review-rating-form">
                                <fieldset>
                                    <input type="radio" name="review-rating" id="review-rating-id1" class="review-rating-id" value="rating">
                                    <label for="review-rating-id1" class="rating-start-label">1 Star</label>

                                    <input type="radio" name="review-rating" id="review-rating-id2" class="review-rating-id" value="rating">
                                    <label for="review-rating-id2" class="rating-start-label">2 Stars</label>

                                    <input type="radio" name="review-rating" id="review-rating-id3" class="review-rating-id" value="rating">
                                    <label for="review-rating-id3" class="rating-start-label">3 Stars</label>

                                    <input type="radio" name="review-rating" id="review-rating-id4" class="review-rating-id" value="rating">
                                    <label for="review-rating-id4" class="rating-start-label">4 Stars</label>

                                    <input type="radio" name="review-rating" id="review-rating-id5" class="review-rating-id" value="rating">
                                    <label for="review-rating-id5" class="rating-start-label">5 Stars</label>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="review-parent-div">
                    <div class="review-image-div">
                        <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                    </div>

                    <div class="review-feedback-div">

                        <textarea readonly class="review-text-area" rows=5 cols=105 style="resize: none"></textarea>

                        <hr/>
                        
                        <div class="review-stars-div">
                            <form action="URL" class="review-rating-form">
                                <fieldset>
                                    <input type="radio" name="review-rating" id="review-rating-id1-1" class="review-rating-id" value="rating">
                                    <label for="review-rating-id1-1" class="rating-start-label">1 Star</label>

                                    <input type="radio" name="review-rating" id="review-rating-id2-1" class="review-rating-id" value="rating">
                                    <label for="review-rating-id2-1" class="rating-start-label">2 Stars</label>

                                    <input type="radio" name="review-rating" id="review-rating-id3-1" class="review-rating-id" value="rating">
                                    <label for="review-rating-id3-1" class="rating-start-label">3 Stars</label>

                                    <input type="radio" name="review-rating" id="review-rating-id4-1" class="review-rating-id" value="rating">
                                    <label for="review-rating-id4-1" class="rating-start-label">4 Stars</label>

                                    <input type="radio" name="review-rating" id="review-rating-id5-1" class="review-rating-id" value="rating">
                                    <label for="review-rating-id5-1" class="rating-start-label">5 Stars</label>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="review-parent-div">
                    <div class="review-image-div">
                        <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                    </div>

                    <div class="review-feedback-div">

                        <textarea readonly class="review-text-area" rows=5 cols=105 style="resize: none"></textarea>

                        <hr/>
                        
                        <div class="review-stars-div">
                            <form action="URL" class="review-rating-form">
                                <fieldset>
                                    <input type="radio" name="review-rating" id="review-rating-id1-2" class="review-rating-id" value="rating">
                                    <label for="review-rating-id1-2" class="rating-start-label">1 Star</label>

                                    <input type="radio" name="review-rating" id="review-rating-id2-2" class="review-rating-id" value="rating">
                                    <label for="review-rating-id2-2" class="rating-start-label">2 Stars</label>

                                    <input type="radio" name="review-rating" id="review-rating-id3-2" class="review-rating-id" value="rating">
                                    <label for="review-rating-id3-2" class="rating-start-label">3 Stars</label>

                                    <input type="radio" name="review-rating" id="review-rating-id4-2" class="review-rating-id" value="rating">
                                    <label for="review-rating-id4-2" class="rating-start-label">4 Stars</label>

                                    <input type="radio" name="review-rating" id="review-rating-id5-2" class="review-rating-id" value="rating">
                                    <label for="review-rating-id5-2" class="rating-start-label">5 Stars</label>
                                </fieldset>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div> <!--Reviews Account Management Right -->
        </div> <!--Main Div -->
    </body>
</html>