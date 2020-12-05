<?php
require_once( "inc/is_logged_in.inc.php" );
require_once( "inc/load_messages.inc.php" );
$member_id = "";
if( is_logged_in() )
    if( isset($_POST["target_id"]) ) {
        $member_id = $_SESSION["member_id"];
        $target_id = $_POST["target_id"];
        $messages = load_messages( $member_id, $target_id );
    }
    else {
        // PLACEHOLDER: Remove this 'else' block once selecting conversations is implemented.
        $member_id = "38";
        $target_id = "39";
        $messages = load_messages( $member_id, $target_id );
    }
else
    header( "location: /luv/createAccountBody.html" );
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
    <script type="text/javascript" src="main.js"></script>
    
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
    
<body class="landing-page">
    <div class="top-bar">
        <div class="navbar">
            <div id="nav-placeholder"></div>

            <!-- fix this up later, move to main.js -->
            <script>
                $(function(){
                  $("#nav-placeholder").load("modules/nav.html");
                });
            </script>
        </div>
    </div>
    <div class="messages-div">
        <div class="users">
            <h1 class="users-label">Users</h1>
            <hr />
            
            <div class="users-placeholder">
                <div id = "admin-profile-pic-div">    
                    <img src="profilepic.png" id = "admin-profile-pic">
                    <p id="admin-reported-user-name" class="profile-username">User name1</p>
                </div>
                
                <div id = "admin-profile-pic-div">    
                    <img src="profilepic.png" id = "admin-profile-pic">
                    <p id="admin-reported-user-name" class="profile-username">User name2</p>
                </div>
          
            </div>
            
        </div>
        
        <div class="users-messages-divider"></div>
        
        <div class="message-history">
            <h1 class="message-history-label">Message History</h1>
            <hr />
            <button class="match-button">MATCH</button>
            
            <hr />
            
            <div class="scrollable">
                <div class="message-history-placeholder">
                    <div id="message-container-div" class="message-container-div">
                        <?php
                        foreach( $messages as $msg ) {
                            $msg_color_class = "message-orange-div";
                            $msg_timestamp_class = "message-timestamp-right";

                            if( $msg["member_id"] == $target_id ) {
                                $msg_color_class = "message-blue-div";
                            }

                            $content = $msg["content"];
                            $timestamp = $msg["timestamp"];

                            $message_html = 
                                "<div class='$msg_color_class'>
                                    <p class='message-content'>$content</p>
                                    <div class='$msg_timestamp_class'>$timestamp</div>
                                </div>";
                            echo $message_html;
                        }
                        ?>
                    </div>

                    <script>
                        var show_sent_message = function( div_color, message_data ) {
                            var outer_div = document.createElement( "DIV" );
                            var p = document.createElement( "P" );
                            var inner_div = document.createElement( "DIV" );

                            outer_div.classList.add( div_color );
                            p.classList.add( "message-content" );
                            inner_div.classList.add( "message-timestamp-left" );


                            p.innerHTML = message_data.content;
                            inner_div.innerHTML = message_data.timestamp;

                            outer_div.appendChild( p );
                            outer_div.appendChild( inner_div ); 
                            document.getElementById( "message-container-div" ).appendChild( outer_div );
                        }
                        var send_message = function() {
                            let message_div = document.getElementById( "send-message-text" )
                            if( message_div.value != "" ) {
                                $.ajax({
                                    url: 'inc/send_message.inc.php',
                                    type: 'POST',
                                    data: {
                                        sender_id: '<?php echo $member_id; ?>',
                                        target_id: '<?php echo $target_id; ?>',
                                        message: message_div.value
                                    },
                                    success: function( data ) {
                                        let message_div = document.getElementById( "send-message-text" );
                                        message_div.value = "";
                                    }                          
                                });
                            }
                        };
                    </script>
                
                
                    <div class="send-message-div">
                        <input type="text" id="send-message-text" placeholder="Send Message"/>
                        <button type="send-message" id="send-message-button" onclick="send_message()">Send</button>
                    </div>

                    <script>
                        // add event to send-message-text to push the send-message-button
                        // when enter key is pressed
                        document.getElementById( "send-message-text").addEventListener("keyup", event => {
                            if(event.key !== "Enter")
                                return; 
                            document.getElementById( "send-message-button" ).click();
                            event.preventDefault(); // just in case
                        });

                        if( typeof(EventSource) !== "undefined" ) {
                            var event_source = new EventSource( "inc/inform_messaging.inc.php" );
                            event_source.onmessage = event => {
                                var msg = JSON.parse( event.data );
                                var member_id = "<?php echo $member_id; ?>";

                                var div_color = "message-orange-div";
                                if( member_id == msg.target_id )
                                    div_color = "message-blue-div";
                                show_sent_message( div_color, msg );
                            };
                        }
                    </script>
            </div>
            </div>
        </div>
    </div>
    
</body>