<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['add_event'])) ){
        header('Location: events.php');
        exit();
    }

    $title = "Moje nowe wydarzenie";
    $date = date('Y-m-d');
    $description = "Opis mojego wydarzenia";
    $logo_src ="NULL";

    //sql query
    $sql = "INSERT INTO events (id, creator_id, title, date, description, logo_src) VALUES (NULL,'".$_SESSION['user_id']."','$title','$date','$description','$logo_src')";
    
    //create connection to database
    $db = new db();

    if($result = $db->query($sql)){
        //get id of the created event
        $event_id = $db->get_inserted_id();
        echo 
        '<!--CARD-->
        <div class="col">
            <div class="event_card">
                <div class="event_card_img_container">
                    <span class="edit_icon" onclick="editEvent(this)" data-disabled="1" data-id="'.$event_id.'"><i class="fas fa-edit"></i></span>
                    <span class="delete_icon"  data-id="'.$event_id.'"><i class="fas fa-trash-alt"></i></span>
                    <label for="add_event_card_img" onclick="triggerInputFile(this)" class="add_img_button hide" data-id="'.$event_id.'">
                         <i class="fas fa-images"></i>
                    </label>
                    <input name="event_card_img" disabled onchange="previewLogo(this)" type="file" class="input_file" accept="image/*" data-function="input-file" data-type="input" data-id="'.$event_id.'"/>
                    <img class="event_card_img" src="" data-type="preview" data-id="'.$event_id.'">
                </div>
                <div class="event_card_body">
                    <input class="event_card_title" disabled type="text" name="event_title" value="'.$title.'" data-type="input" data-id="'.$event_id.'"/>
                    <div class="event_card_date">
                        <i class="fas fa-calendar-alt"></i>
                        <input disabled class="event_card_date_value" type="text" value="'.$date.'" data-type="input" data-id="'.$event_id.'">
                    </div> 
                    <div class="event_card_creator">
                        <p class="font-weight-bold">Założyciel:</p>
                        <div class="event_card_creator_avatar_container">
                            <img class="avatar_image" src="'.$_SESSION['user_avatar'].'" alt="Creator avatar">
                        </div>
                        <p>'.$_SESSION['user_name'].'</p>
                    </div>
                    <p class="font-weight-bold">Opis:</p>
                    <textarea class="event_card_description" disabled rows="4" name="event_description" data-type="input" data-id="'.$event_id.'">'.$description.'</textarea>
                    <button class="enter_event_button" data-id="'.$event_id.'">WEJDŹ</button>
                </div>
            </div>
        </div>
        <!--CARD END-->';

        //sql query
        $sql = "INSERT INTO members (id, event_id, member_id) VALUES (NULL,'$event_id','".$_SESSION['user_id']."')";
        //try to add user to member's of the event
        if($result = $db->query($sql)){
            //succes
        }
    }

    //close connection to database
    unset($db);
?>