<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";

    if((!isset($_POST['email'])) || (!isset($_POST['password']))){
        header('Location: index.php');
        exit();
    }
    //create data base connection
    $db = new db();
    //get values from form
    $email = $_POST['email'];
    $password = $_POST['password'];
    //prevent from sql injection
    $email = htmlentities($email, ENT_QUOTES, "UTF-8");
    //sql query
    $sql = "SELECT * FROM users WHERE BINARY email='$email'";

    if($result = $db->query($sql)){
        //check if user exists in data base
        $user_count = $result->num_rows;
        if($user_count>0){
            $row = $result->fetch_assoc();
            //check if password is correct
            if(password_verify($password,$row['password'])){
                $_SESSION['logged'] = true;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['username'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_avatar'] = $row['avatar_src'];
                unset($_SESSION['login_err']);
                $result->free_result();
                header('Location: events.php');
            }
            else{
                $_SESSION['login_err'] = '<p class="error_text">Niepoprawny login lub hasło!</p>'; 
                header('Location: login_page.php');
            }
        }
        else{
            $_SESSION['login_err'] = '<p class="error_text">Niepoprawny login lub hasło!</p>'; 
            header('Location: login_page.php');
        }
    }
    //close data base connection
    unset($db);

?>