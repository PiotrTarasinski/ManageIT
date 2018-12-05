<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['sign_off_from_event'])) ){
        header('Location: events.php');
        exit();
    }

    $event_id = $_POST['event_id'];
    $user_id = $_SESSION['user_id'];

    //sql query
    $sql ="DELETE FROM members WHERE event_id = '$event_id' AND member_id = '$user_id'";
    //create connection to database
    $db = new db();

    if($result = $db->query($sql)){
        //succes
    }

    //close connection to database
    unset($db);
?>