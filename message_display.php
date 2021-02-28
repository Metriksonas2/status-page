<?php 
    $message_key = $err ? $_GET["err"] : $_GET["success"];
    
    if(($message = MessageHandler::getMessage($message_key)) !== false){
        $color = $err ? "message-error" : "message-success";
        
        echo '<h3 class="message '. $color . '">' . $message . '</h3>';
    }
?>