<?php

function display_navbar(){
    require_once "data_base.php";
    //create data base connection
    $db = new db();
    //sql query
    $sql = "SELECT * FROM messages WHERE recipient='".$_SESSION['user_id']."'";
    $messages_count = 0;
    if($result = $db->query($sql)){
        $messages_count = $result->num_rows;
        $result->free_result();
    }
    //close data base connection
    unset($db);

    //display navbar
    echo 
    '<!-- Navbar -->
    <nav class="navbar navbar-expand navbar-light">
        <div class="container">
            <a class="navbar-brand" href="events.php"><img src="img/manageIT_logo.png" alt="ManageIT Logo"></a>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="nav_avatar_container rounded-circle">
                            <img class="avatar_image" src="'.$_SESSION['user_avatar'].'" alt="User Avatar">';
                            if($messages_count>0){
                                echo
                                '<div class="message_container">
                                    <i class="fas fa-envelope"></i>
                                </div>';
                            }
                        echo
                       '</div>
                        <p class="username">'.$_SESSION['user_name'].'</p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="fas fa-envelope"></i> Wiadomości <span class="badge badge-primary">'.$messages_count.'</span></a>
                        <a class="dropdown-item" href="#"><i class="fas fa-user-edit"></i> Edytuj profil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item log_out_button" href="log_out.php"><i class="fas fa-sign-out-alt"></i> Wyloguj się</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav> 
    <!--End Of Navbar -->';
}
?>