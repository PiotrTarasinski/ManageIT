<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['show_messages'])) ){
        header('Location: events.php');
        exit();
    }

    //sql query
    $sql = "SELECT messages.id, users.username, events.title, messages.event_id FROM messages, users, events WHERE messages.recipient_id = '".$_SESSION['user_id']."' AND messages.sender_id = users.id AND messages.event_id = events.id";
    //create connection to database
    $db = new db();

    if($result = $db->query($sql)){
        while($messages = $result->fetch_assoc()){
            echo
            '<div class="message_box" data-id="'.$messages['id'].'">
                <p>'.$messages['username'].' wysyła Ci zaproszenie do wzięcia udziału przy organizacji wydarzenia "'.$messages['title'].'"</p>
                <span class="message_decision accept_invite" data-id="'.$messages['id'].'" data-event_id="'.$messages['event_id'].'"><i class="far fa-check-circle pr-1"></i>Akceptuj</span>
                <span class="message_decision discard_invite" data-id="'.$messages['id'].'"><i class="far fa-times-circle pr-1"></i>Odrzuć</span>
            </div>';
        }
    }

    //close connection to database
    unset($db);
?>