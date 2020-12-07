<?php
require_once( "inc/is_logged_in.inc.php" );
require_once( "inc/logging.inc.php" );
require_once( "inc/reports.inc.php" );

$reports = [];
if( is_logged_in() ) {
    $reports = load_reports();
}
else
    header( "location: /luv/createAccountBody.php" );
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
            <button type="submit" id="admin-sign-out-button" name="submit-signout">Sign Out</button>
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

    <div id="reports-wrapper" class="scrollable">
    </div>
    
    <script>
        var report_results = <?php echo json_encode($reports); ?>;
        report_results.forEach( report => {
            var name = report.name;
            var picture = report.picture;
            var reporter = report.member_id;
            var target = report.target_id;
            var timestamp = report.timestamp;
            var content = report.content;

            var outer = document.createElement( "DIV" );
            outer.classList.add( "admin-reported-account-main-div" );

            var div1_outer = document.createElement( "DIV" );
            div1_outer.classList.add( "admin-reported-account-label-div" );
            outer.appendChild( div1_outer );
            var div2_div1 = document.createElement( "DIV" );
            div2_div1.classList.add( "admin-profile-pic-div" );
            div1_outer.appendChild( div2_div1 );
            var img1_div2 = document.createElement( "IMG" );
            img1_div2.classList.add( "admin-profile-pic" );
            img1_div2.src = picture;
            div2_div1.appendChild( img1_div2 );
            var p1_div2 = document.createElement( "P" );
            p1_div2.classList.add( "admin-reported-user-name" );
            p1_div2.classList.add( "profile-username" )
            p1_div2.innerHTML = name;
            div2_div1.appendChild( p1_div2 );

            var div3_outer = document.createElement( "DIV" );
            div3_outer.classList.add( "admin-reported-account-label-div" );
            outer.appendChild( div3_outer );
            var ta1_div3 = document.createElement( "TEXTAREA" );
            ta1_div3.classList.add( "admin-report-description-text-area" );
            ta1_div3.rows = "7";
            ta1_div3.cols = "90";
            ta1_div3.style.resize = "none";
            ta1_div3.value = content;
            div3_outer.appendChild( ta1_div3 );
            var hr1_div3 = document.createElement( "HR" );
            div3_outer.appendChild( hr1_div3 );
            var div4_div3 = document.createElement( "DIV" );
            div4_div3.classList.add( "admin-buttons-div" );
            div3_outer.appendChild( div4_div3 );
            var form1_div4 = document.createElement( "FORM" );
            form1_div4.classList.add( "admin-buttons-form" );
            form1_div4.method = "post";
            div4_div3.appendChild( form1_div4 );
            var input1_form1 = document.createElement( "INPUT" );
            input1_form1.classList.add( "admin-delete-button" );
            input1_form1.type = "submit";
            input1_form1.value = "Delete Account";
            input1_form1.name = "submit_delete";
            form1_div4.appendChild( input1_form1 );
            var input2_form1 = document.createElement( "INPUT" );
            input2_form1.classList.add( "admin-ignore-button" );
            input2_form1.type = "submit";
            input2_form1.value = "Ignore";
            input2_form1.name = "submit_ignore";
            form1_div4.appendChild( input2_form1 );
            var input3_form1 = document.createElement( "INPUT" );
            input3_form1.type = "hidden";
            input3_form1.name = "member_id";
            input3_form1.value = reporter;
            form1_div4.appendChild( input3_form1 );
            var input4_form1 = document.createElement( "INPUT" );
            input4_form1.type = "hidden";
            input4_form1.name = "target_id";
            input4_form1.value = target;
            form1_div4.appendChild( input4_form1 );
            var input5_form1 = document.createElement( "INPUT" );
            input5_form1.type = "hidden";
            input5_form1.name = "timestamp";
            input5_form1.value = timestamp;
            form1_div4.appendChild( input5_form1 );

            var div5_outer = document.createElement( "DIV" );
            outer.appendChild( div5_outer );
            var p2_div5 = document.createElement( "P" );
            p2_div5.innerHTML = timestamp;
            div5_outer.appendChild( p2_div5 );

            document.getElementById( "reports-wrapper" ).appendChild( outer );     
        });
    </script>
</body>
</html>