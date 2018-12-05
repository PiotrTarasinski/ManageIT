<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['add_friends_search'])) ){
        header('Location: events.php');
        exit();
    }

    $event_id = $_POST['event_id'];
    $searched_user = $_POST['searched_user'];

    //sql query
    $sql = "SELECT id, avatar_src, username FROM users WHERE username LIKE '%$searched_user%' LIMIT 50";
    //create connection to database
    $db = new db();

    if($result = $db->query($sql)){
        while($users = $result->fetch_assoc()){
            $sql = "SELECT * FROM members WHERE event_id = '$event_id' AND member_id = '".$users['id']."'";
            if($result2 = $db->query($sql)){
                $member = $result2->num_rows;
                if($member>0){
                    echo
                    '<div class="member_container">
                        <div class="avatar_container">
                            <img class="avatar_image" src="'.$users['avatar_src'].'" alt="Avatar Image">
                        </div>
                        <p class="member_name">'.$users['username'].'</p>
                        <span class="already_member"><i class="fas fa-users pr-1"></i><span class="send_invite_text">Członek zespołu</span></span>
                    </div>';
                }
                else{
                    $sql = "SELECT * FROM messages WHERE event_id = '$event_id' AND recipient_id = '".$users['id']."'";
                    if($result3 = $db->query($sql)){
                        $invite = $result3->num_rows;
                        if($invite>0){
                            echo
                            '<div class="member_container">
                                <div class="avatar_container">
                                    <img class="avatar_image" src="'.$users['avatar_src'].'" alt="Avatar Image">
                                </div>
                                <p class="member_name">'.$users['username'].'</p>
                                <span class="already_member"><i class="far fa-envelope pr-1"></i></i><span class="send_invite_text">Wysłano zaproszenie</span></span>
                            </div>';
                        }
                        else{
                            echo
                            '<div class="member_container">
                                <div class="avatar_container">
                                    <img class="avatar_image" src="'.$users['avatar_src'].'" alt="Avatar Image">
                                </div>
                                <p class="member_name">'.$users['username'].'</p>
                                <span class="send_invite" data-user_id="'.$users['id'].'"><i class="fas fa-envelope pr-1"></i><span class="send_invite_text">Wyślij zaproszenie</span></span>
                            </div>';
                        }
                    }
                }
            }
        }
    }

    //close connection to database
    unset($db);
?>