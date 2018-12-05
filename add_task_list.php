<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['add_task_list'])) ){
        header('Location: events.php');
        exit();
    }

    $title = "Nowa lista zadań";
    $date = date('Y-m-d');
    $event_id = $_POST['event_id'];

    //sql query
    $sql = "INSERT INTO tasks_list (id, event_id, title, date) VALUES (NULL,'$event_id','$title','$date')";
    
    //create connection to database
    $db = new db();

    if($result = $db->query($sql)){
        //get id of the created task list
        $task_list_id = $db->get_inserted_id();
        echo 
        '<div>
        <div class="task_card" data-id="'.$task_list_id.'">
            <span class="delete_task_list" data-id="'.$task_list_id.'"><i class="fas fa-trash-alt"></i></span>
            <input class="task_title" type="text" data-type="input" data-id="'.$task_list_id.'" data-name="title" value="'.$title.'"/>
            <div class="task_card_body">
                <div class="task_date_container">
                    <p class="date_title"><i class="fas fa-calendar-alt"></i> Termin</p>
                    <div class="task_card_date">
                        <input class="task_date_value" type="text" value="'.$date.'" data-type="input" data-name="date" data-id="'.$task_list_id.'">
                    </div>
                </div>
                <h5><i class="fas fa-code-branch"></i> Ukończono</h5>
                <div class="progress mb-2">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" data-id="'.$task_list_id.'">0%</div>
                </div>
                <h5><i class="fas fa-users"></i> Odpowiedzialni <span class="add_member" data-id="'.$task_list_id.'"><i class="fas fa-user-plus"></i> Dodaj</span></h5>
                <div class="members_container" >
                </div>  
                <h5>Zadania <span class="add_task" data-id="'.$task_list_id.'"><i class="fas fa-thumbtack"></i> Dodaj zadanie</span></h5>
                <div class="task_container" data-id="'.$task_list_id.'"> 
                </div>
            </div>
        </div>
        </div>';
    }

    //close connection to database
    unset($db);
?>