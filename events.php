<?php
    //check if user got acces to this page
    session_start();
    if(!isset($_SESSION['logged'])){
        header('Location: login_page.php');
        exit();
    }
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
        <!-- Navbar -->
        <nav class="navbar navbar-expand-sm navbar-light">
            <div class="container">
                <a class="navbar-brand" href="events.php"><img src="img/manageIT_logo.png" alt="ManageIT Logo"></a>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="nav_avatar_container rounded-circle">
                                <img class="avatar_image" src="img/default_avatar.png" alt="User Avatar">
                            </div>
                            <p class="username">Piotr Tarasiński</p>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Wiadomości <span class="badge badge-primary">0</span></a>
                            <a class="dropdown-item" href="#">Edytuj profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="log_out.php">Wyloguj się</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav> 
        <!--End Of Navbar -->
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>