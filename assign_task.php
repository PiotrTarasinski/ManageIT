<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['assign_task'])) ){
        header('Location: events.php');
        exit();
    }

    $task_list_id = $_POST['task_list_id'];
    $user_id = $_POST['user_id'];

    //sql query
    $sql = "INSERT INTO tasks_members (id, task_id, member_id) VALUES (NULL, '$task_list_id', '$user_id')";
    //create connection to database
    $db = new db();

    if($result = $db->query($sql)){
        $sql = "SELECT users.avatar_src, users.username FROM users WHERE users.id='$user_id'";
        if($result2 = $db->query($sql)){
            $user = $result2->fetch_assoc();
            echo
            '<div class="member_container" data-id="'.$task_list_id.'" data-user_id="'.$user_id.'">
                <div class="avatar_container">
                    <img class="avatar_image" src="'.$user['avatar_src'].'" alt="Avatar Image">
                </div>
                <p class="member_name">'.$user['username'].'</p>
                <span class="delete_member" data-id="'.$task_list_id.'" data-user_id="'.$user_id.'"><i class="fas fa-times-circle"></i></span>
            </div>';
        }
    }

    //close connection to database
    unset($db);
?>