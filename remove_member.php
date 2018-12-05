<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['remove_member'])) ){
        header('Location: events.php');
        exit();
    }

    $task_list_id = $_POST['task_list_id'];
    $user_id = $_POST['user_id'];

    //sql query
    $sql ="DELETE FROM tasks_members WHERE task_id = '$task_list_id' AND member_id = '$user_id'";
    //create connection to database
    $db = new db();

    if($result = $db->query($sql)){
        //succes
    }

    //close connection to database
    unset($db);
?>