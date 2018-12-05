<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['remove_event'])) ){
        header('Location: events.php');
        exit();
    }

    $event_id = $_POST['event_id'];

    //sql query
    $sql ="DELETE FROM events WHERE events.id = '$event_id'";
    //create connection to database
    $db = new db();

    if($result = $db->query($sql)){
        //succes
    }

    //close connection to database
    unset($db);
?>