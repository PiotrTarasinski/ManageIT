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
                    <!--CARD-->
                    <div class="col">
                        <div class="event_card">
                            <div class="event_card_img_container">
                                <span class="edit_icon" onclick="editEvent(this)" data-disabled="1" data-id="1"><i class="fas fa-edit"></i></span>
                                <span class="delete_icon"  data-id="1"><i class="fas fa-trash-alt"></i></span>
                                <label for="add_event_card_img" onclick="triggerInputFile(this)" class="add_img_button" data-id="1"></label>
                                <input name="event_card_img" disabled onchange="previewLogo(this)" type="file" class="input_file" accept="image/*" data-function="input-file" data-type="input" data-id="1"/>
                                <img class="event_card_img" src="img/manageIT_logo.png" alt="Event Image" data-type="preview" data-id="1">
                            </div>
                            <div class="event_card_body">
                                <input class="event_card_title" disabled type="text" name="event_title" value="IT Academic Day 2018" data-type="input" data-id="1"/>
                                <div class="event_card_date" id="date_time_picker">
                                    <i class="fas fa-calendar-alt"></i>
                                    <input id="event_date" disabled class="event_card_date_value" type="text" value="2018-12-11" data-type="input" data-id="1">
                                </div> 
                                <div class="event_card_creator">
                                    <p class="font-weight-bold">Założyciel:</p>
                                    <div class="event_card_creator_avatar_container">
                                        <img class="avatar_image" src="img/default_avatar.png" alt="Creator avatar">
                                    </div>
                                    <p>Piotr Tarasiński</p>
                                </div>
                                <p class="font-weight-bold">Opis:</p>
                                <textarea class="event_card_description" disabled rows="4" name="event_description" data-type="input" data-id="1">Jakiś super opis no kurde ale on jest piękny. Super wydarzenie!Jakiś super opis no kurde ale on jest piękny. Super wydarzenie!Jakiś super opis no kurde ale on jest piękny. Super wydarzenie!</textarea>
                                <button class="enter_event_button" data-id="1">WEJDŹ</button>
                            </div>
                        </div>
                    </div>
                    <!--CARD END-->
                </div>
            </div>
            
        </div>
    </div>
        
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <script src="js/events.js"></script>
</body>
</html>