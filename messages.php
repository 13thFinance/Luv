<?php
require_once( "inc/is_logged_in.inc.php" );
require_once( "inc/messaging.inc.php" );
require_once( "inc/conversations.inc.php" );
require_once( "inc/confirm_message_receipt.inc.php" );
require_once( "inc/get_match_state.inc.php" );
require_once( "inc/new_match.inc.php" );

$member_id = "";
$target_id = "";
$match_state = [];
$messages = [];

if( is_logged_in() ) {
    $member_id = $_SESSION["member_id"];
    
    
    if( isset($_POST["target_id"]) ) {
        $target_id = $_POST["target_id"];

        // attempt to add conversation
        create_conversation( $member_id, $target_id );

        // load history from current conversation
        $member_id = $_SESSION["member_id"];
        $messages = load_messages( $member_id, $target_id );

        $match_state = get_match_state( $member_id, $target_id );
    }

    // load conversations
    $conversations =  load_conversations( $member_id );
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
    <script>
        var send_message = function() {
            let message_div = document.getElementById( "send-message-text" )
            if( message_div.value != "" ) {
                $.ajax({
                    url: 'inc/messaging.inc.php',
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
    <div class="messages-div">
        <div class="users">
            <h1 class="users-label">Users</h1>
            <hr />
            
            <div class="users-placeholder" id="conversation-head-wrapper">
            </div>
            <script>
                var add_conversation_head = conv => {
                    outer_div = document.createElement( "DIV" );
                    outer_div.classList.add( "admin-profile-pic-div" );

                    form_div = document.createElement( "FORM" );
                    form_div.action = "messages.php";
                    form_div.method = "post";

                    
                    img_div = document.createElement( "INPUT" );
                    img_div.classList.add( "admin-profile-pic" );
                    img_div.classList.add( "picCircle" );
                    img_div.src = conv.picture;
                    img_div.type = "image";

                    hidden_div = document.createElement( "INPUT" );
                    hidden_div.type = "hidden";
                    hidden_div.name = "target_id";
                    hidden_div.value = conv.target_id;

                    p_div = document.createElement( "P" );
                    p_div.classList.add( "profile-username" );
                    p_div.classList.add( "admin-reported-user-name" );
                    p_div.innerHTML = conv.name;

                    form_div.appendChild( img_div );
                    form_div.appendChild( hidden_div );
                    outer_div.appendChild( form_div );
                    outer_div.appendChild( p_div );

                    document.getElementById( "conversation-head-wrapper" ).appendChild( outer_div );
                };
                var conversations = <?php echo json_encode($conversations); ?>;
                conversations.forEach( conv => {
                    add_conversation_head( conv );
                });
            </script>
                
        </div>
        
        <div class="users-messages-divider"></div>
        
        <div class="message-history">
            <h1 class="message-history-label">Message History</h1>
            
            <hr />
            <script>
                var match_button_clicked = () => {
                    var member_id = "<?php echo $member_id; ?>";
                    var target_id = "<?php echo $target_id; ?>";

                    if( target_id != "" ){
                        $.ajax({
                            url: 'inc/new_match.inc.php',
                            type: 'POST',
                            data: {
                                member_id: member_id,
                                target_id: target_id
                            },
                            success: function() {
                                $.ajax({
                                    url: 'inc/get_match_state.inc.php',
                                    type: 'POST',
                                    data: {
                                        member_id: member_id,
                                        target_id: target_id
                                    },
                                    success: function( response ) {
                                        var match_data = response ;
                                        format_match_button( JSON.parse(match_data) );
                                    }
                                });
                            }
                        });
                    }
                };
            </script>
            
            <button id="match_button" class="match-button" onclick="match_button_clicked()">MATCH</button>

            <script>
                var format_match_button = (match_data) => {
                    // member_match and target_match are strings, "true" or "false"
                    console.log( match_data.member_match ); //delete these console outputs
                    console.log( match_data.target_match );                    

                    var btn = document.getElementById( "match_button" );
                    btn.disabled = false;
                    // I guess disable it if member_match == "true"
                    // and target_match == "false"?

                    // Crazy formatting if you're matched?!
                    // Do we need a realtime event for when two people match?
                    // Probably :`D```
                }
                
                var target_id = "<?php echo $target_id; ?>";
                if( !target_id == "" ) {
                    var match_state = <?php echo $match_state; ?>;
                    format_match_button( match_state );
                }
            </script>
            
            
                <div class="message-history-placeholder">
                    <div id="message-container-div" class="message-container-div scrollable-message">
                            <?php
                            foreach( $messages as $msg ) {
                                $msg_color_class = "message-orange-div";
                                $msg_timestamp_class = "message-timestamp-right";

                                if( $msg["member_id"] == $target_id ) {
                                    $msg_color_class = "message-blue-div";
                                }

                                if( $msg["member_id"] == $target_id and $msg["read"] == "0" )
                                    confirm_message_receipt( $msg["member_id"], $msg["target_id"], $msg["timestamp"], "true" );
                                elseif( $msg["member_id"] == $member_id and $msg["delivered"] == "0" )
                                    confirm_message_receipt( $msg["member_id"], $msg["target_id"], $msg["timestamp"], "false" );

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
                    var element = document.getElementById("message-container-div");
                    element.scrollTop = element.scrollHeight;
                </script>
                    
                <script>
                    var show_sent_message = function( is_recipient, message_data ) {
                        var outer_div = document.createElement( "DIV" );
                        var p = document.createElement( "P" );
                        var inner_div = document.createElement( "DIV" );

                        if( is_recipient ) {
                            outer_div.classList.add( "message-blue-div" );
                        }
                        else {
                            outer_div.classList.add( "message-orange-div" ); 
                        }

                        inner_div.classList.add( "message-timestamp-right" );
                        p.classList.add( "message-content" );
                    
                        p.innerHTML = message_data.content;
                        inner_div.innerHTML = message_data.timestamp;

                        outer_div.appendChild( p );
                        outer_div.appendChild( inner_div ); 
                        document.getElementById( "message-container-div" ).appendChild( outer_div );
                        outer_div.scrollIntoView();
                        $.ajax({
                            url: 'inc/confirm_message_receipt.inc.php',
                            type: 'POST',
                            data: {
                                member_id: message_data.member_id,
                                target_id: message_data.target_id,
                                timestamp: message_data.timestamp,
                                is_recipient: is_recipient
                            }  
                        });
                    }
                </script>
                
                <?php if( $target_id == "" ) {
                    echo
                    '<div class="send-message-div">
                        <input type="text" id="send-message-text" placeholder="Send Message" disabled/>
                        <button type="send-message" id="send-message-button" onclick="send_message()" disabled>Send</button>
                    </div>';
                }
                else {
                    echo
                    '<div class="send-message-div">
                        <input type="text" id="send-message-text" placeholder="Send Message" />
                        <button type="send-message" id="send-message-button" onclick="send_message()" >Send</button>
                    </div>';
                }
                ?>

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
                            if( event && event.data ) {
                                var msg = JSON.parse( event.data );
                                if( msg.member_id != undefined ) {
                                    var member_id = "<?php echo $member_id; ?>";
                                    var target_id = "<?php echo $target_id; ?>";

                                    var is_recipient = false;
                                    if( member_id == msg.member_id && target_id == msg.target_id && msg.delivered == "0" ) {
                                        // This is the sender. Show them their own message.
                                        show_sent_message( is_recipient, msg );
                                    }
                                    else if( member_id == msg.target_id && target_id == msg.member_id && msg.read == "0" ) {
                                        // This is the recipient. Show them the sender's message.
                                        is_recipient = true;
                                        show_sent_message( is_recipient, msg );
                                    }
                                    else if( member_id == msg.target_id && msg.read == "0" ) {
                                        // This is the recipient, not actively in a conversation with the sender.
                                        is_recipient = true;
                                        $.ajax({
                                            url: 'inc/conversations.inc.php',
                                            type: 'POST',
                                            data: {
                                                member_id: msg.target_id,
                                                target_id: msg.member_id
                                            },
                                            success: function( response ) {
                                                var data = JSON.parse( response );
                                                if( data.existed == "false" ) {
                                                    add_conversation_head( data );
                                                }
                                                $.ajax({
                                                    url: 'inc/confirm_message_receipt.inc.php',
                                                    type: 'POST',
                                                    data: {
                                                        member_id: msg.member_id,
                                                        target_id: msg.target_id,
                                                        timestamp: msg.timestamp,
                                                        is_recipient: is_recipient
                                                    }
                                                });
                                            }
                                        });
                                        
                                    }
                                }
                            }
                        };
                    }
                </script>
            
            </div>
        </div>
    </div>
    
</body>
