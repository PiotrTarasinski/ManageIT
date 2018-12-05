<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['send_invite_message'])) ){
        header('Location: events.php');
        exit();
    }

    $sender_id = $_SESSION['user_id'];
    $event_id = $_POST['event_id'];
    $recipient_id = $_POST['recipient_id'];

    //sql query
    $sql = "INSERT INTO messages (id, sender_id, recipient_id, event_id) VALUES (NULL,'$sender_id','$recipient_id','$event_id')";
    
    //create connection to database
    $db = new db();

    if($result = $db->query($sql)){
        
    }

    //close connection to database
    unset($db);
?>