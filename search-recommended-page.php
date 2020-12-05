<?php
require_once( "inc/logging.inc.php" );
require_once( "inc/is_logged_in.inc.php" );
require_once( "inc/mysql.inc.php" );
require_once( "inc/search.inc.php" );

$personalities = [];

if( is_logged_in() ) {
    $session_start;
    $member_id = $_SESSION["member_id"];

    $search_results = [];
    if( isset($_GET["recommended"]) or isset($_POST["recommended"]) ) {
        $search_results = search_recommended_users( $member_id );
        
    }
    elseif ( isset($_POST["search"]) ) {
        if ( isset($_POST["searchtext"]) ) {
            LOG_DEBUG( "about to run a search" );
            $search_results = search_users( $_POST["searchtext"] );
        }
    }
}
else
    header( "location: /luv" );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>Search Recommended</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <script type="text/javascript" src="main.js"></script>
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
    
    
    <div class="search-recommended-main-div">
        <form class="search-sub-div" action="search-recommended-page.php" method="post">
            <input type="text" id="search-text" name="searchtext" placeholder="Search Users"/>
            <button type="submit" id="search-button" name="search">Search</button>
            <button type="submit" id="recommended-button" name="recommended">Recommended</button>
        </form>
    </div>


    <script>
        var search_results = <?php echo json_encode($search_results); ?>;
        search_results.forEach( member => {
            // PLACEHOLDER CONSOLE OUTPUT
            console.log( member.name );
            console.log( member.about_me );
            console.log( member.picture );

            // CREATE DIVS HERE AND APPEND THEM TO THE BODY ELEMENT
        });
    </script>
    
    <!--
    <div class="search-result-recommended-parent-div">
        <div class="search-profile-image-div">
            <img src="profilepic.png" class = "reviewProfilePic">
            <p id="search-profile-user-name" class="profile-username">User name</p>
        </div>

        <div class="search-profile-feedback-div">

            <textarea readonly class="search-profile-aboutme-text-area" rows=8 cols=80 style="resize: none"></textarea>

            <div class="review-stars-div">
                <form action="" class="review-rating-form">
                    <label>Rating:</label>
                    <br>
                    <input type="radio" name="review-rating" id="search-profile-rating-id1" class="review-rating-id" value="rating">
                    <label for="search-profile-rating-id1" class="rating-start-label">1 Star</label>

                    <input type="radio" name="review-rating" id="search-profile-rating-id2" class="review-rating-id" value="rating">
                    <label for="search-profile-rating-id2" class="rating-start-label">2 Stars</label>

                    <input type="radio" name="review-rating" id="search-profile-rating-id3" class="review-rating-id" value="rating">
                    <label for="search-profile-rating-id3" class="rating-start-label">3 Stars</label>

                    <input type="radio" name="review-rating" id="search-profile-rating-id4" class="review-rating-id" value="rating">
                    <label for="search-profile-rating-id4" class="rating-start-label">4 Stars</label>

                    <input type="radio" name="review-rating" id="search-profile-rating-id5" class="review-rating-id" value="rating">
                    <label for="search-profile-rating-id5" class="rating-start-label">5 Stars</label>
                </form>
            </div>
        </div>
        -->

        <!-- buttons -->
        <!--
        <div class="seach-profile-button-div" action="">
            <form class="search-profile-form">
                <input type="button" id="search-profile-view-button" class="search-profile-button" value="View" onclick="goto('ViewOthersProfile.html');"/>

                <input type="button" id="search-profile-message-button" class="search-profile-button" value="Message" onclick="goto('messages.html');"/>
            </form>
        </div>
    </div>
    -->
</body>
</html>