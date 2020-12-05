<?php
require_once( "inc/is_logged_in.inc.php" );
$about_me_text = "";
if( is_logged_in() ) {
    $about_me_text = "YOU'RE SUPER LOGGED IN";
    $session_start;
    $member_id = $_SESSION["member_id"];
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
                    
                    <div class="image-upload">
                      <label for="file-input">
                          <div id = "profilePicDiv">  
                            <img src="profilepic.png" id = "profilePic" alt="ppic"/>
                          </div>
                      </label>

                      <input id="file-input" type="file" />
                    </div>
                    
                      
                    
                    <div id="name-personality-pair">
                         <div id="userName">
                            <div class = "frameBodyAccountManagement">  
                                <div class = "frameTitleAccountManagement"> Name </div>
                                <input type = "text" id = "nameBoxInput" placeholder="Input Name">
                            </div>
                        </div>

                        <div id="userPersonality">
                            <div class = "frameBodyAccountManagement">  
                                <div class = "frameTitleAccountManagement"> Personality </div>
                                <select id = "personality-selection">
                                    <option> Select Personality</option>
                                    <option> INFP </option>
                                    <option> ENFP </option>
                                    <option> INFJ </option>
                                    <option> ENFJ </option>
                                    <option> INTJ </option>
                                    <option> ENTJ </option>
                                    <option> INTP </option>
                                    <option> ENTP </option>
                                    <option> ISFP </option>
                                    <option> ESFP </option>
                                    <option> ISTP </option>
                                    <option> ESTP </option>
                                    <option> ISFJ </option>
                                    <option> ESFJ </option>
                                    <option> ISTJ </option>
                                    <option> ESTJ </option>
                                </select>
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
                            <input type = "text" id = "sexBoxInput" placeholder="Input Sex Preference">
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
                            <input type = "text" id = "ageBoxInput" placeholder="Input Age">
                        </div>
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Looking For </div>
                            <input type = "text" id = "lookingForBoxInput" placeholder="Looking for...">
                        </div>
                    </div>
                    <div id="jobTitleDiv">
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Job Title </div>
                            <input type = "text" id = "jobTitleBoxInput" placeholder="Input Job Title">
                        </div>
                    </div>
                    <div id="locationDiv">
                        <div class = "frameBodyAccountManagement">  
                            <div class = "frameTitleAccountManagement"> Location </div>
                            <input type = "text" id = "locationBoxInput" placeholder="Where are you from?">
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
                
                <div class="scrollable">
                <!--would need a php comment request + loop display to work properly
                use bottom as base for the display loop-->
                
                    <div class="review-parent-div">

                        <div class="review-image-div">
                            <div>
                                <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                            </div>

                            <div>
                                <p id="review-username" class="review-profile-pic-name">Username</p>
                            </div>
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

                    <!--end display-->
                    <!--would need a php comment request + loop display to work properly
                    use bottom as base for the display loop-->

                    <div class="review-parent-div">

                        <div class="review-image-div">
                            <div>
                                <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                            </div>

                            <div>
                                <p id="review-username" class="review-profile-pic-name">Username</p>
                            </div>
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

                    <!--end display-->
                    <!--would need a php comment request + loop display to work properly
                    use bottom as base for the display loop-->

                    <div class="review-parent-div">

                        <div class="review-image-div">
                            <div>
                                <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                            </div>

                            <div>
                                <p id="review-username" class="review-profile-pic-name">Username</p>
                            </div>
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

                    <!--end display-->
                    <!--would need a php comment request + loop display to work properly
                    use bottom as base for the display loop-->

                    <div class="review-parent-div">

                        <div class="review-image-div">
                            <div>
                                <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                            </div>

                            <div>
                                <p id="review-username" class="review-profile-pic-name">Username</p>
                            </div>
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

                    <!--end display-->
                    <!--would need a php comment request + loop display to work properly
                    use bottom as base for the display loop-->

                    <div class="review-parent-div">

                        <div class="review-image-div">
                            <div>
                                <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                            </div>

                            <div>
                                <p id="review-username" class="review-profile-pic-name">Username</p>
                            </div>
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

                    <!--end display-->
                    <!--would need a php comment request + loop display to work properly
                    use bottom as base for the display loop-->

                    <div class="review-parent-div">

                        <div class="review-image-div">
                            <div>
                                <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                            </div>

                            <div>
                                <p id="review-username" class="review-profile-pic-name">Username</p>
                            </div>
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

                    <!--end display-->
                    <!--would need a php comment request + loop display to work properly
                    use bottom as base for the display loop-->

                    <div class="review-parent-div">

                        <div class="review-image-div">
                            <div>
                                <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                            </div>

                            <div>
                                <p id="review-username" class="review-profile-pic-name">Username</p>
                            </div>
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

                    <!--end display-->
                    <!--would need a php comment request + loop display to work properly
                    use bottom as base for the display loop-->

                    <div class="review-parent-div">

                        <div class="review-image-div">
                            <div>
                                <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                            </div>

                            <div>
                                <p id="review-username" class="review-profile-pic-name">Username</p>
                            </div>
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

                    <!--end display-->
                    <!--would need a php comment request + loop display to work properly
                    use bottom as base for the display loop-->

                    <div class="review-parent-div">

                        <div class="review-image-div">
                            <div>
                                <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                            </div>

                            <div>
                                <p id="review-username" class="review-profile-pic-name">Username</p>
                            </div>
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

                    <!--end display-->
                    <!--would need a php comment request + loop display to work properly
                    use bottom as base for the display loop-->

                    <div class="review-parent-div">

                        <div class="review-image-div">
                            <div>
                                <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                            </div>

                            <div>
                                <p id="review-username" class="review-profile-pic-name">Username</p>
                            </div>
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

                    <!--end display-->
                    <!--would need a php comment request + loop display to work properly
                    use bottom as base for the display loop-->

                    <div class="review-parent-div">

                        <div class="review-image-div">
                            <div>
                                <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                            </div>

                            <div>
                                <p id="review-username" class="review-profile-pic-name">Username</p>
                            </div>
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

                    <!--end display-->
                    <!--would need a php comment request + loop display to work properly
                    use bottom as base for the display loop-->

                    <div class="review-parent-div">

                        <div class="review-image-div">
                            <div>
                                <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                            </div>

                            <div>
                                <p id="review-username" class="review-profile-pic-name">Username</p>
                            </div>
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

                    <!--end display-->
                    <!--would need a php comment request + loop display to work properly
                    use bottom as base for the display loop-->

                    <div class="review-parent-div">

                        <div class="review-image-div">
                            <div>
                                <img src="profilepic.png" class = "reviewProfilePic" alt="ppic">
                            </div>

                            <div>
                                <p id="review-username" class="review-profile-pic-name">Username</p>
                            </div>
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
                </div> <!-- end scrollable-->
                
                <!--end display-->
                
            </div> <!--Reviews Account Management Right -->
        </div> <!--Main Div -->
    </body>
</html>