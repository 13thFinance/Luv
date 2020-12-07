<?php
require_once( "inc/is_logged_in.inc.php" );
    if( is_logged_in() )
        header( "location: accountManagement.php" );
?>

<!DOCTYPE html>

<!--
landing page for luv dating site
-->
    
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <title>LUV</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
</head>
    
<body class="landing-page">
    
    <div class="top-bar">
        <div class="navbar">
            <div id="nav-placeholder"></div>

            <script>
                $(function(){
                  $("#nav-placeholder").load("modules/nav.html");
                });
            </script>
        </div>
            
        <div class="create-login">
            <div id="create-login-placeholder"></div>

            <script>
                $(function(){
                  $("#create-login-placeholder").load("modules/createlogin.html");
                });
            </script>
        </div>
    </div>
    
    <div class="splash-text">
            <h1 class="title-card noselect">It's Personal</h1>
            <p class="splash-bottom noselect">The Luv Dating Website</p>
    </div>
    
</body>