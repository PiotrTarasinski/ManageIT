<?php
    //check if user got acces to this page
    session_start();
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
        header('Location: events.php');
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
    <link rel="stylesheet" href="css/login_and_register_page.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>

<body>
    <div class="hero_body">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="index.php"><img src="img/manageIT_logo.png" alt="ManageIT Logo"></a>
                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="login_page.php">ZALOGUJ SIĘ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register_page.php">ZAREJESTRUJ SIĘ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> 
        <!--End Of Navbar -->
        <!-- Main -->
        <div class="main">
            <div class="container">
                <div class="register_container">
                    <form action="register.php" method="post" enctype="multipart/form-data">
                        <h1>ZAREJESTRUJ SIĘ</h1>
                        <div class="row">
                            <div class="col">
                                <h2>Avatar</h2>
                                <div class="avatar_container rounded-circle">
                                    <label for="avatar" class="add_img_button" id="add_avatar_register"></label>
                                    <input name="avatar" onchange="previewAvatar(this)" type="file" class="input_file" accept="image/*" id="avatar_register"/>
                                    <img src="img/default_avatar.png" class="avatar_img" alt="Avatar Image" id="avatar_preview">
                                </div>
                                <h2>Nazwa użytkownika</h2>
                                <input name="username" type="text" placeholder="Podaj nazwę użytkownika"/>
                            </div>
                            <div class="col">
                                <h2>Adres email</h2>
                                <input name="email" type="email" placeholder="Podaj adres email"/>
                                <h2>Hasło</h2>
                                <input name="password" type="password" placeholder="Wpisz hasło"/>
                                <h2>Potwierdź hasło</h2>
                                <input name="password2" type="password" placeholder="Potwierdź hasło"/>
                            </div>
                        </div>
                        <?php
                            if(isset($_SESSION['register_err'])){
                                echo $_SESSION['register_err'];
                            }
                        ?>
                        <input class="button" type="submit" value="Zarejestruj się">
                        <p class="pt-3">Masz już konto? <a class="highlighted_link" href="login_page.php">Zaloguj się!</a></p>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Of Main -->
        
    </div>





    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <script src="js/register_form.js"></script>
</body>
</html>