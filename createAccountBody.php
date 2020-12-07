
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LUV Create Account</title>
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
    
    <div class="form-div">
        <div class="sub-form-div">
            <form id="create-account-form" action="inc/create_account.inc.php" method="post">
                <div class="form-header">
                    Create Account
                </div>
                <div class="create-account-form-class">
                    <div>
                        <input type="text" id ="full-name" class ="account-field" name="name" placeholder="Full Name" maxlength="100"/>
                    </div>
                    <!--<div>
                        <input type="text" id ="last-name" class ="account-field" placeholder="Last Name"/>
                    </div>-->
                    <div>
                        <input type="email" id ="create-email" class ="account-field" name="email" placeholder="Email" maxlength="320"/>
                    </div>
                    <div>
                        <input type="password" id ="create-password" class ="account-field" name="password" placeholder="Password"/>
                    </div>
                    <div>
                        <input type="password" id="create-confirm-password" class ="account-field" placeholder="Confirm Password"/>
                    </div>
                    <hr/>
                    <div class="button-div">
                        <button type="submit" id="submitProfile" class="create-account-submit" name="submit">Create Account</button>
                    </div>
                    <?php 
                    session_start();
                    if( isset($_SESSION["account_exists_error"]) and $_SESSION["account_exists_error"] == true ) {
                        echo "<p class='frontend-error-message'>Account already exists.</p>";
                        unset( $_SESSION["account_exists_error"] );
                    }
                    ?>
                </div>
            </form>
        </div>
        
        <!-- <div class="vertical-line-div"></div> -->
        
        <div class="sub-form-div">
            <form id="login-form" action="inc/login.inc.php" method="post">
                <div class="form-header">
                    Login
                </div>
                <div class="login-form-class">
                    <div>
                        <input type="email" id="login-email" class="account-field" name="login-email" placeholder="Email" maxlength="320"/>
                    </div>
                    <div>
                        <input type="password" id="login-password" class="account-field" name="login-password" placeholder="Password" />
                    </div>
                    <hr/>
                    <div class="button-div">
                        <button type="submit" id="submitProfile" class="create-account-submit" name="submit">Login</button>
                    </div>
                    <?php 
                    session_start();
                    if( isset($_SESSION["invalid_login_error"]) and $_SESSION["invalid_login_error"] == true ) {
                        echo "<p class='frontend-error-message'>Invalid email/password.</p>";
                        unset( $_SESSION["invalid_login_error"] );
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</body>