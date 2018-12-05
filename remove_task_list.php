<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['remove_task_list'])) ){
        header('Location: events.php');
        exit();
    }

    $task_list_id = $_POST['task_list_id'];

    //sql query
    $sql ="DELETE FROM tasks_list WHERE tasks_list.id = '$task_list_id'";
    //create connection to database
    $db = new db();

    if($result = $db->query($sql)){
        //succes
    }

    //close connection to database
    unset($db);
?>