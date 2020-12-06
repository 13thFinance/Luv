<?php
require_once( "inc/is_logged_in.inc.php" );
require_once( "inc/mysql.inc.php" );
require_once( "inc/logging.inc.php" );
require_once( "inc/reviews.inc.php" );

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

$reviews = [];
if( is_logged_in() ) {
    $session_start;
    $member_id = $_SESSION["member_id"];

    $query_string = "SELECT name, personality, about_me, sex, gender, age, looking_for, job_title, location, picture FROM members WHERE member_id=?";
    $query_params = [$member_id];
    $query_result = db_query($query_string, $query_params);

    if( $query_result === false ){
        // PLACEHOLDER
        die( "Something went wrong" );
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

    $reviews = load_reviews($member_id);
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
                <form id = "accountManagementForm" action="inc/upload_user_data.inc.php" method="post" enctype="multipart/form-data">
                    <div class="image-upload">
                      <label for="file-input">
                          <div id = "profilePicDiv">
                            <img src="<?php echo $picture; ?>" id="profilePic" alt="ppic"/>
                          </div>
                      </label>
                      <input id="file-input" type="file" accept="image/*" name="profile_pic" />
                    </div>

                    <div id="name-personality-pair">
                         <div id="userName">
                            <div class = "frameBodyAccountManagement">  
                                <div class = "frameTitleAccountManagement"> Name </div>
                                <input type = "text" id = "nameBoxInput" name="nameBoxInput" placeholder="Input Name" value="<?php echo $users_name ?>">
                            </div>
                        </div>

                        <div id="userPersonality">
                            <div class = "frameBodyAccountManagement">  
                                <div class = "frameTitleAccountManagement"> Personality </div>
                                <select id = "personality-selection" name="personalityBoxInput" value="<?php echo $personality ?>">
                                    <option value="" hidden> Select Personality</option>
                                    <option value="INFP"> INFP </option>
                                    <option value="ENFP"> ENFP </option>
                                    <option value="INFJ"> INFJ </option>
                                    <option value="ENFJ"> ENFJ </option>
                                    <option value="INTJ"> INTJ </option>
                                    <option value="ENTJ"> ENTJ </option>
                                    <option value="INTP"> INTP </option>
                                    <option value="ENTP"> ENTP </option>
                                    <option value="ISFP"> ISFP </option>
                                    <option value="ESFP"> ESFP </option>
                                    <option value="ISTP"> ISTP </option>
                                    <option value="ESTP"> ESTP </option>
                                    <option value="ISFJ"> ISFJ </option>
                                    <option value="ESFJ"> ESFJ </option>
                                    <option value="ISTJ"> ISTJ </option>
                                    <option value="ESTJ"> ESTJ </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="aboutMeDiv">
                        <div id = "aboutMeBody">
                            <div id = "aboutMeTitle"> About Me</div>
                            <textarea id = "aboutMeInput" name="aboutMeInput" rows = "12" cols = "60" style="resize: none"><?php echo "$about_me_text"; ?></textarea>
                        </div>
                    </div>
                    
                    <div id = "sexGenderDiv">
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Sex </div>
                            <input type = "text" id = "sexBoxInput" name="sexBoxInput" placeholder="Input Sex Preference" value="<?php echo $sex ?>">
                        </div>
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Gender </div>
                            <select id = "genderSelectionMenu" name="genderSelectionMenu" value="<?php echo $gender ?>">
                            <option value="" hidden> Select Gender </option>
                            <option value="male"> Male </option>
                            <option value="female"> Female </option>
                            <option value="other"> Other </option>
                            </select>
                        </div>
                    </div>
                    
                    <div id = "ageLookingForDiv">
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Age </div>
                            <input type = "text" id = "ageBoxInput" name="ageBoxInput" placeholder="Input Age" value="<?php echo $age ?>">
                        </div>
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Looking For </div>
                            <input type = "text" id = "lookingForBoxInput" name="lookingForBoxInput" placeholder="Looking for..." value="<?php echo $looking_for ?>">
                        </div>
                    </div>
                    <div id="jobTitleDiv">
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Job Title </div>
                            <input type = "text" id = "jobTitleBoxInput" name="jobTitleBoxInput" placeholder="Input Job Title" value="<?php echo $job_title ?>">
                        </div>
                    </div>
                    <div id="locationDiv">
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Location </div>
                            <input type = "text" id = "locationBoxInput" name="locationBoxInput" placeholder="Where are you from?" value="<?php echo $location ?>">
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
                <script>
                    function selectDropDownOption(id, option_value){
                        var drop_down = document.getElementById(id);
                        var num_options = drop_down.options.length;
                        for (var i = 0; i < num_options; i++){
                            if (drop_down.options[i].value == option_value){
                                drop_down.options[i].selected = true;
                                break;
                            }
                        }
                    }
                    selectDropDownOption("personality-selection", "<?php echo $personality ?>");
                    selectDropDownOption("genderSelectionMenu", "<?php echo $gender ?>");
                </script>
            </div> 
            
            <!--Left Profile Div -->
            
            
            <div class="vertical-line-div2"></div>
            

            <div id = "reviewsAccountManagement-Right">
                <div class="reviews-space-div"> </div>
                <div id = "reviewsLabelDiv">
                    <label id = "reviewsLabel">
                        Reviews
                    </label>    
                </div>
                
                <div id ="review-wrapper" class="scrollable">
                    
                </div> <!-- end scrollable-->
                
                
                <script>
                    var reviews_results = <?php echo json_encode($reviews); ?>;
                    reviews_results.forEach( review => {

                        // PLACEHOLDER CONSOLE OUTPUT

                        var name = review.name;
                        var picture = review.picture;
                        var rating = review.rating;
                        var content = review.content;
                        console.log(review);
                        
                        /*
                        <div class="review-parent-div">

                            <div class="review-image-div">
                                <div>
                                    <img src="img/profile/default.png" class = "reviewProfilePic" alt="ppic">
                                </div>

                                <div>
                                    <p id="review-username" class="review-profile-pic-name">Username</p>
                                </div>
                            </div>

                            <div class="review-feedback-div">

                                <textarea readonly class="review-text-area" rows=5 cols=105 style="resize: none"></textarea>

                                <hr/>
                                <div class="review-stars-flex-div">
                                    <div class="review-stars-div">
                                       <img src="img/profile/heart.png" alt="<3">
                                    </div>
                                    <div class="review-stars-div">
                                       <img src="img/profile/heart.png" alt="<3">
                                    </div>
                                    <div class="review-stars-div">
                                       <img src="img/profile/heart.png" alt="<3">
                                    </div>
                                    <div class="review-stars-div">
                                       <img src="img/profile/heart.png" alt="<3">
                                    </div>
                                    <div class="review-stars-div">
                                       <img src="img/profile/heart.png" alt="<3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        */
                        
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
                        var stars_div = document.createElement( "DIV" );
                        var stars_image = document.createElement( "IMG" );
                        
                        review_parent_div.classList.add("review-parent-div");
                        review_image_div.classList.add("review-image-div");
                        profile_image_source.classList.add("reviewProfilePic");
                        username_p.classList.add("review-profile-pic-name");
                        feedback_div.classList.add("review-feedback-div");
                        review_textarea.classList.add("review-text-area");
                        review_stars_div.classList.add("review-stars-flex-div");
                        
                        review_textarea.row = "10";
                        review_textarea.cols = "105";
                        review_textarea.style.resize = "none";
                        review_textarea.innerHTML = content;
                        profile_image_source.src = picture;
                        profile_image_source.alt = "img/profile/default.png";
                        username_p.innerHTML = name;
                        
                        
                        // add more hearts per rating
                        stars_div.appendChild(stars_image);
                        var i;
                        for (i = 1; i <= rating; i++) {
                            
                            var stars_div = document.createElement( "DIV" );
                            var stars_image = document.createElement( "IMG" );
                            
                            stars_div.classList.add("review-stars-div");
                            stars_image.src = "img/profile/heart.png";
                            stars_image.alt = "<3";
                            
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
                
                <!--end display-->
                
            </div> <!--Reviews Account Management Right -->
        </div> <!--Main Div -->
    </body>
</html>