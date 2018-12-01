<?php
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
                <div class="login_container">
                    <form action="login.php" method="post">
                        <h1>ZALOGUJ SIĘ</h1>
                        <h2>Adres email</h2>
                        <input name="email" type="email" placeholder="Podaj adres email">
                        <h2>Hasło</h2>
                        <input name="password" type="password" placeholder="Wpisz hasło">
                        <?php
                            if(isset($_SESSION['login_err'])){
                                echo $_SESSION['login_err'];
                            }
                        ?>
                        <input class="button" type="submit" value="Zaloguj się">
                        <p class="pt-3">Nie masz konta? <a class="highlighted_link" href="register_page.php">Zarejestruj się!</a></p>
                    </form>
                </div>
            </div> 
        </div>
        <!-- End Of Main -->
        
    </div>






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>