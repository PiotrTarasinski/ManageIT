<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['edit_task_list'])) ){
        header('Location: events.php');
        exit();
    }

    $task_list_id = $_POST['task_list_id'];
    $name = $_POST['name'];
    $value = $_POST['value'];
    $task_id = $_POST['task_id'];

    //sql query
    if($name == "title"){
        $sql ="UPDATE tasks_list SET title = '$value' WHERE tasks_list.id = '$task_list_id'";
    }
    else if($name == "date"){
        $sql ="UPDATE tasks_list SET date = '$value' WHERE tasks_list.id = '$task_list_id'";
    }
    else if($name == "task_description"){
        $sql ="UPDATE tasks SET description = '$value' WHERE tasks.id = '$task_id'";
    }
    //create connection to database
    $db = new db();

    if($result = $db->query($sql)){
    }

    //close connection to database
    unset($db);
?>