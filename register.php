<?php
    //check if user got acces to this page
    session_start();
    if(!isset($_POST['username'])){
        header('Location: register_page.php');
        exit();
    }
    //get values from form and validate them
    $username = $_POST['username'];
    if(strlen($username)<3 || strlen($username)>30){
        $_SESSION['register_err'] = '<p class="error_text">Nazwa użytkownika musi zawierać od 3 do 30 znaków!</p>';
        exit_on_err();
    }
    $email = $_POST['email'];
    $emailB = filter_var($email,FILTER_SANITIZE_EMAIL);
    if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($email!=$emailB)){
        $_SESSION['register_err'] = '<p class="error_text">Niepoprawny adres email!</p>';
        exit_on_err();
    }
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    if(strlen($password)<6 || strlen($password)>20){
        $_SESSION['register_err'] = '<p class="error_text">Hasło musi zawierać od 6 do 20 znaków!</p>';
        exit_on_err();
    }
    if($password!=$password2){
        $_SESSION['register_err'] = '<p class="error_text">Hasła nie są takie same!</p>';
        exit_on_err();
    }
    //prevent from sql injection and encrypt password
    $email = htmlentities($email, ENT_QUOTES, "UTF-8");
    $username = htmlentities($username, ENT_QUOTES, "UTF-8");
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    //create connection to database
    require_once "data_base.php";
    $db = new db();

    //check if this email already exists in data base
    $sql = "SELECT * FROM users WHERE BINARY email='$email'";
    if($result = $db->query($sql)){
        $user_count = $result->num_rows;
        if($user_count>0){
            $_SESSION['register_err'] = '<p class="error_text">Istnieje już konto przypisane do tego adresu email!</p>';
            unset($db);
            exit_on_err();
        }
        else{
            //if user doesn't included avatar image set it to default avatar
            if($_FILES['avatar']['size'] == 0){
                $avatar="img/default_avatar.png";
            }
            else{
                //validate user's file
                $target_dir = "img/avatars/";
                $target_file = $target_dir . rand() . basename($_FILES["avatar"]["name"]);
                $imageFileType =  strtolower(pathinfo(basename($_FILES["avatar"]["name"]),PATHINFO_EXTENSION));
                $check = getimagesize($_FILES["avatar"]["tmp_name"]);
                if($check == false){
                    $_SESSION['register_err'] = '<p class="error_text">Wybrany plik nie jest zdjęciem!</p>';
                    unset($db);
                    exit_on_err();
                }
                // Check if file already exists
                if (file_exists($target_file)){
                    $_SESSION['register_err'] = '<p class="error_text">Wystąpił błąd serwera, spróbuj ponownie poźniej!</p>';
                    unset($db);
                    exit_on_err();
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
                    $_SESSION['register_err'] = '<p class="error_text">Możesz przesłać plik jedynie o rozszerzeniu JPG, JPEG, PNG i GIF!</p>';
                    unset($db);
                    exit_on_err();
                }
                //Try to upload file on server
                if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)){
                    $avatar = $target_file;
                } else {
                    $_SESSION['register_err'] = '<p class="error_text">Wystąpił błąd serwera, spróbuj ponownie poźniej!</p>';
                    unset($db);
                    exit_on_err();
                }
            }
            //try to create new user in data base
            $sql = "INSERT INTO users (id, email, username, password, avatar_src) VALUES (NULL,'$email','$username','$password_hash','$avatar')";
            if($result = $db->query($sql)){
                header('Location: registration_succes.php');
                unset($_SESSION['register_err']);
                $_SESSION['registered'] = true;
            }
        }
    }
    //close connection to database
    unset($db);

    function exit_on_err(){
        header('Location: register_page.php');
        exit();
    }
?>