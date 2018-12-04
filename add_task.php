<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['add_task'])) ){
        header('Location: events.php');
        exit();
    }

    $task_list_id = $_POST['task_list_id'];
    $status = 0;
    $description = "Nowe zadanie";

    //sql query
    $sql = "INSERT INTO tasks (id, task_list_id, status, description) VALUES (NULL, '$task_list_id', '$status', '$description')";
    //create connection to database
    $db = new db();

    if($result = $db->query($sql)){
        //get id of the created task list
        $task_id = $db->get_inserted_id();
        echo 
        '<div class="task" data-id="'.$task_list_id.'" data-task_id="'.$task_id.'">
            <span class="delete_task" data-id="'.$task_list_id.'" data-task_id="'.$task_id.'"><i class="fas fa-times-circle"></i></span>
            <input class="task_checkbox" data-id="'.$task_list_id.'" data-task_id="'.$task_id.'" type="checkbox">
            <input class="task_description" data-id='.$task_list_id.'"" data-task_id="'.$task_id.'" data-type="input" value="Nowe zadanie" type="text"/>
        </div>';
    }

    //close connection to database
    unset($db);
?>