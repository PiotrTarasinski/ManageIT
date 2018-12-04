<?php
    //check if user got acces to this page
    session_start();
    if(!isset($_SESSION['logged']) || !isset($_GET['event_id'])){
        header('Location: login_page.php');
        exit();
    }
    $event_id = $_GET['event_id'];
    $event_id = htmlentities($event_id, ENT_QUOTES, "UTF-8");
    require_once "data_base.php";
    $sql = "SELECT * from members WHERE members.event_id=".$event_id." AND members.member_id=".$_SESSION['user_id']."";
    $db = new db();
    if($result = $db->query($sql)){
        $user_count = $result->num_rows;
        if($user_count<1){
            header('Location: events.php');
            unset($db);
            exit();
        }
    }
    else{
        header('Location: events.php');
        unset($db);
        exit();
    }
    require_once "navbar.php";
?>

<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage IT</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!-- Addons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700" rel="stylesheet"> 
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet"href="css/event_manager.css">
    <link rel="stylesheet" href="css/navbar_logged.css">
</head>

<body>

    
    <div class="hero_body">
        <?php
            display_navbar();
        ?>
        
        <div class="tasks_container">
            <h1 class="events_header">IT Academic Day 2018</h1>
            <button class="add_friends"><i class="fas fa-user-plus"></i> Zaproś znajomych</button>
            <div class="main">
            
            <?php
                $sql = "SELECT * FROM tasks_list WHERE event_id = ".$_GET['event_id']."";
                if($result = $db->query($sql)){
                    while($task_list = $result->fetch_assoc()){
                        echo
                        '<div>
                        <div class="task_card" data-id="'.$task_list['id'].'">
                            <span class="delete_task_list" data-id="'.$task_list['id'].'"><i class="fas fa-trash-alt"></i></span>
                            <input class="task_title" type="text" data-type="input" data-id="'.$task_list['id'].'" data-name="title" value="'.$task_list['title'].'"/>
                            <div class="task_card_body">
                                <div class="task_date_container">
                                    <p class="date_title"><i class="fas fa-calendar-alt"></i> Termin</p>
                                    <div class="task_card_date">
                                        <input class="task_date_value" type="text" value="'.$task_list['date'].'" data-type="input" data-name="date" data-id="'.$task_list['id'].'">
                                    </div>
                                </div>
                                <h5><i class="fas fa-code-branch"></i> Ukończono</h5>
                                <div class="progress mb-2">
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="'.$task_list['progress'].'" aria-valuemin="0" aria-valuemax="100" data-id="'.$task_list['id'].'">'.$task_list['progress'].'%</div>
                                </div>
                                <h5><i class="fas fa-users"></i> Odpowiedzialni <span class="add_member" data-id="'.$task_list['id'].'"><i class="fas fa-user-plus"></i> Dodaj</span></h5>
                                <div class="members_container" >';
                                $sql = "SELECT tasks_members.member_id , users.avatar_src, users.username from tasks_members, users WHERE tasks_members.task_id=".$task_list['id']."";
                                if($result2 = $db->query($sql)){
                                    while($members_list = $result2->fetch_assoc()){
                                        echo
                                        '<div class="member_container" data-id="'.$task_list['id'].'" data-user_id="'.$members_list['member_id'].'">
                                            <div class="avatar_container">
                                                <img class="avatar_image" src="'.$members_list['avatar_src'].'" alt="Avatar Image">
                                            </div>
                                            <p class="member_name">'.$members_list['username'].'</p>
                                            <span class="delete_member" data-id="'.$task_list['id'].'" data-user_id="'.$members_list['member_id'].'"><i class="fas fa-times-circle"></i></span>
                                        </div>';
                                    }
                                }
                                echo
                                '</div>  
                                <h5>Zadania <span class="add_task" data-id="'.$task_list['id'].'"><i class="fas fa-thumbtack"></i> Dodaj zadanie</span></h5>
                                <div class="task_container" data-id="'.$task_list['id'].'">';
                                $sql = "SELECT * from tasks WHERE task_list_id=".$task_list['id']."";
                                if($result3 = $db->query($sql)){
                                    while($task = $result3->fetch_assoc()){
                                        echo
                                        '<div class="task" data-id="'.$task_list['id'].'" data-task_id="'.$task['id'].'">
                                            <span class="delete_task" data-id="'.$task_list['id'].'" data-task_id="'.$task['id'].'"><i class="fas fa-times-circle"></i></span>';
                                            if($task['status']==0){
                                                echo '<input class="task_checkbox" data-id="'.$task_list['id'].'" data-task_id="'.$task['id'].'" type="checkbox">';
                                            }
                                            else{
                                                echo '<input class="task_checkbox" data-id="'.$task_list['id'].'" data-task_id="'.$task['id'].'" type="checkbox" checked>';
                                            }
                                            echo
                                            '<input class="task_description" data-id="'.$task_list['id'].'" data-task_id="'.$task['id'].'" data-type="input" value="'.$task['description'].'" type="text"/>
                                        </div>';
                                    }
                                }
                                echo
                                '</div>
                            </div>
                        </div>
                        </div>';
                    }
                }
            ?>
                <div class="add_task_list_container">
                    <span class="add_task_list"><i class="fas fa-tasks pr-2"></i>Dodaj nową listę zadań</span>
                </div>
            </div>
        </div>
    </div>
        
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <script src="js/event_manager.js"></script>
</body>
</html>