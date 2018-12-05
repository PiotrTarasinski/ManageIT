<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['show_members'])) ){
        header('Location: events.php');
        exit();
    }

    $event_id = $_POST['event_id'];
    $task_list_id = $_POST['task_list_id'];
    

    //sql query
    $sql = "SELECT members.member_id, users.avatar_src, users.username FROM members, users WHERE members.event_id='$event_id' AND members.member_id = users.id";
    //create connection to database
    $db = new db();

    if($result = $db->query($sql)){
        while($members = $result->fetch_assoc()){
            $sql = "SELECT * FROM tasks_members WHERE member_id = '".$members['member_id']."' AND task_id = '$task_list_id'";
            if($result2 = $db->query($sql)){
                $assigned = $result2->num_rows;
                if($assigned > 0){
                    echo
                    '<div class="member_container">
                        <div class="avatar_container">
                            <img class="avatar_image" src="'.$members['avatar_src'].'" alt="Avatar Image">
                        </div>
                        <p class="member_name">'.$members['username'].'</p>
                        <span class="already_member"><i class="fas fa-user-check pr-1"></i><span class="send_invite_text">Przydzielono</span></span>
                    </div>';
                }
                else{
                    echo
                    '<div class="member_container">
                        <div class="avatar_container">
                            <img class="avatar_image" src="'.$members['avatar_src'].'" alt="Avatar Image">
                        </div>
                        <p class="member_name">'.$members['username'].'</p>
                        <span class="assign_task" data-id="'.$task_list_id .'" data-user_id="'.$members['member_id'].'"><i class="fas fa-check pr-1"></i><span class="send_invite_text">Przydziel zadanie</span></span>
                    </div>';
                }
            }
        }
    }

    //close connection to database
    unset($db);
?>