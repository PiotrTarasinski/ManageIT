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
            exit();
        }
    }
    else{
        header('Location: events.php');
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
        
        <div class="container">
            <h1 class="events_header">IT Academic Day 2018</h1>
            <button class="add_friends"><i class="fas fa-user-plus"></i> Zaproś znajomych</button>
            <div class="main">
                <div class="task_card">
                    <div class="task_container">
                        <input type="text" data-id=""/>
                    </div>
                    <div class="task_container">
                        <h5>Opis</h5>
                        <textarea class="event_card_description" rows="4" data-type="input" data-id=""></textarea>
                    </div>
                    <div class="task_container">
                        <div class="event_card_date">
                            <i class="fas fa-calendar-alt"></i>
                            <input class="task_date_value" type="text" value="" data-type="input" data-id="">
                        </div>
                    </div>
                    <div class="task_container">
                        <h5>Odpowiedzialni:</h5>
                        <div class="task_member_container">
                            <div class="avatar_container">
                                <img class="avatar_image" src="" alt="Avatar Image">
                            </div>
                            <p class="username">Piotr Tarasiński</p>
                        </div>
                    </div>  
                    <div class="task_container">
                        <div class="subtask_container">
                            
                        </div>
                    </div>
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