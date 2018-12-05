<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['accept_invite'])) ){
        header('Location: events.php');
        exit();
    }

    $accept_invite = $_POST['accept_invite'];
    $message_id = $_POST['message_id'];
    
    //sql query
    $sql = "DELETE FROM messages WHERE messages.id = '$message_id'";
    //create connection to database
    $db = new db();

    if($result = $db->query($sql)){
        if($accept_invite){
            $event_id = $_POST['event_id'];
            $sql = "INSERT INTO members (id, event_id, member_id) VALUES (NULL, '$event_id', '".$_SESSION['user_id']."')";
            if($result2 = $db->query($sql)){
                //succes
            }
        }
    }

    //close connection to database
    unset($db);
?>