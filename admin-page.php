<?php
require_once( "inc/is_logged_in.inc.php" );
require_once( "inc/logging.inc.php" );
require_once( "inc/reports.inc.php" );

$reports = [];
if( is_logged_in() ) {
    $reports = load_reports();
}
else
    header( "location: /luv/createAccountBody.html" );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <script type="text/javascript" src="main.js"></script>
</head>
<body class="landing-page">
    <form id = "adminSignOutForm" action="inc/logout.inc.php" method="post">
        <!-- Sign out -->
        <div class="admin-sign-out-div">
            <button type="submit" id="admin-sign-out-button" name="admin-signout">Sign Out</button>
        </div>
    </form>
    <h1 class="admin-reported-header">Reported Accounts</h1>
    
    <div class="admin-reported-account-main-div">
        <div class="admin-reported-account-label-div">
            <p>Users</p>
        </div>
        <div class="admin-reported-account-label-div">
            <p>Description of why this account was reported</p>
        </div>
        <div class="admin-reported-account-label-div">
            <p>Date Reported</p>
        </div>
    </div>
    
    <script>
        var report_results = <?php echo json_encode($reports); ?>;
        report_results.forEach( report => {

            // PLACEHOLDER CONSOLE OUTPUT

            var name = report.name;
            var picture = report.picture;
            var reporter = report.member_id;
            var target = report.target_id;
            var timestamp = report.timestamp;
            var content = report.content;
            console.log(report);
            
        });
    </script>

    <div class="scrollable">
        <div class="admin-reported-account-main-div">
            <div class="admin-reported-account-label-div">
                <div class = "admin-profile-pic-div">    
                    <img src="profilepic.png" class = "admin-profile-pic">
                    <p class="admin-reported-user-name" class="profile-username">User name</p>
                </div>
            </div>

            <div class="admin-reported-account-label-div"> 
                <textarea readonly class="admin-report-description-text-area" rows=7 cols=90 style="resize: none"></textarea>

                <hr/>

                <div class="admin-buttons-div">
                    <form class="admin-buttons-form">
                            <input type=submit id="admin-delete-button" value="Delete Account"/>

                            <input type=submit id="admin-ignore-button" value="Ignore"/>        
                    </form>
                </div>

            </div>

            <div class="admin-reported-account-label-div">
                <p id="admin-date-reported-text">10/26/2020</p>
            </div>
        </div>
    </div>
</body>
</html>