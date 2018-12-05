<?php
    //check if user got acces to this page
    session_start();
    if(!isset($_SESSION['logged'])){
        header('Location: login_page.php');
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
    <link rel="stylesheet"href="css/events.css">
    <link rel="stylesheet" href="css/navbar_logged.css">
    <link rel="stylesheet" href="css/windows.css">
</head>

<body>

    
    <div class="hero_body">
        <?php
            display_navbar();
        ?>
        
        <div class="container">
            <h1 class="events_header">Wydarzenia</h1>
            <button class="add_event_button"><i class="fas fa-calendar-plus"></i> Dodaj wydarzenie</button>
            <div class="main">
                <div class="row">
                <?php
                    require_once "data_base.php";
                    $db = new db();
                    $sql = "SELECT members.event_id FROM members WHERE members.member_id=".$_SESSION['user_id']."";
                    if($result = $db->query($sql)){
                        while($events_id = $result->fetch_assoc()){
                            $sql = "SELECT events.creator_id, events.logo_src, events.title, events.date, users.avatar_src, users.username, events.description FROM events, users WHERE events.id=".$events_id['event_id']." AND events.creator_id=users.id";
                            if($result2 = $db->query($sql)){
                                $events_variable = $result2->fetch_assoc();
                                echo 
                                '<div class="col" data-id="'.$events_id['event_id'].'">
                                    <div class="event_card">
                                        <div class="event_card_img_container">';
                                            if($events_variable['creator_id']==$_SESSION['user_id']){
                                                echo
                                                '<span class="edit_icon" onclick="editEvent(this)" data-disabled="1" data-id="'.$events_id['event_id'].'"><i class="fas fa-edit"></i></span>
                                                <span class="delete_icon"  data-id="'.$events_id['event_id'].'"><i class="fas fa-trash-alt"></i></span>';
                                            }
                                            else{
                                                echo
                                                '<span class="sign_off"  data-id="'.$events_id['event_id'].'"><i class="fas fa-times-circle"></i></span>';
                                            }
                                            echo
                                            '<label for="add_event_card_img" onclick="triggerInputFile(this)" class="add_img_button hide" data-id="'.$events_id['event_id'].'">
                                                 <i class="fas fa-images"></i>
                                            </label>
                                            <input name="event_card_img" disabled onchange="previewLogo(this)" type="file" class="input_file" accept="image/*" data-function="input-file" data-type="input" data-id="'.$events_id['event_id'].'"/>
                                            <img class="event_card_img" src="';
                                            if($events_variable['logo_src']!="NULL"){
                                                echo $events_variable['logo_src'];
                                            }
                                            echo
                                            '" data-type="preview" data-id="'.$events_id['event_id'].'">
                                        </div>
                                        <div class="event_card_body">
                                            <input class="event_card_title" disabled type="text" name="event_title" value="'.$events_variable['title'].'" data-type="input" data-id="'.$events_id['event_id'].'"/>
                                            <div class="event_card_date">
                                                <i class="fas fa-calendar-alt"></i>
                                                <input disabled class="event_card_date_value" type="text" value="'.$events_variable['date'].'" data-type="input" data-id="'.$events_id['event_id'].'">
                                            </div> 
                                            <div class="event_card_creator">
                                                <p class="font-weight-bold">Założyciel:</p>
                                                <div class="event_card_creator_avatar_container">
                                                    <img class="avatar_image" src="'.$events_variable['avatar_src'].'" alt="Creator avatar">
                                                </div>
                                                <p>'.$events_variable['username'].'</p>
                                            </div>
                                            <p class="font-weight-bold">Opis:</p>
                                            <textarea class="event_card_description" disabled rows="4" name="event_description" data-type="input" data-id="'.$events_id['event_id'].'">'.$events_variable['description'].'</textarea>
                                            <button class="enter_event_button" data-id="'.$events_id['event_id'].'">WEJDŹ</button>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                    }
                ?>
                </div>
            </div>
            
        </div>
    </div>

    <div id="dialog_window"></div>
        
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <script src="js/events.js"></script>
    <script src="js/windows.js"></script>
</body>
</html>