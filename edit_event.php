<?php
    //check if user got acces to this page
    session_start();
    require_once "data_base.php";
    if((!isset($_SESSION['logged'])) || (!isset($_SESSION['user_id'])) || (!isset($_POST['edit_event'])) ){
        header('Location: events.php');
        exit();
    }

    $id = $_POST['event_id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $logo_src = $_POST['logo_src'];

    //if user doesn't included avatar image set it to default avatar
    if($_FILES['logo_src']['size'] == 0){
        $logo_src="NULL";
    }
    else{
        //validate user's file
        $target_dir = "img/logos/";
        $target_file = $target_dir . rand() . basename($_FILES["logo_src"]["name"]);
        $imageFileType =  strtolower(pathinfo(basename($_FILES["logo_src"]["name"]),PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["logo_src"]["tmp_name"]);
        if($check == false){
            $logo_src="NULL";
        }
        // Check if file already exists
        if (file_exists($target_file)){
            $logo_src="NULL";
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
            $logo_src="NULL";
        }
        //Try to upload file on server
        if (move_uploaded_file($_FILES["logo_src"]["tmp_name"], $target_file)){
            $logo_src = $target_file;
        } else {
            $logo_src="NULL";
        }
    }

    //sql query
    $sql = "UPDATE events SET title = '$title', date = '$date', logo_src = '$logo_src', description = '$description' WHERE events.id = '$id'";
    //create connection to database
    $db = new db();
    if($result = $db->query($sql)){
        //succes
    }
    //close connection to database
    unset($db);
?>