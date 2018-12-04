<?php
    //check if user got acces to this page
    session_start();
    
    if(!isset($_SESSION['registered'])){
        header('Location: register_page.php');
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
</head>

<body>
    <div class="hero_body">
        <!-- Navbar -->
        <nav class="navbar navbar-light">
            <div class="container justify-content-center">
                <a class="navbar-brand" href="index.php"><img src="img/manageIT_logo.png" alt="ManageIT Logo"></a>          
        </nav> 
        <!--End Of Navbar -->
        <!-- Main -->
        <div class="main">
            <div class="container">
                <div class="registration_succes_container">
                    <h1>REJESTRACJA ZAKOŃCZONA</h1>
                    <p class="p-2">Proces rejestracji Twojego konta przebiegł pomyślnie. Dziękujemy za wybranie <span class="highlighted_link">ManageIT</span> oraz za dołączenie do naszej wspaniałej społeczności. Klikając w przycisk znajdujący się poniżej zostaniesz przeniesiony na stronę logowania, gdzie poraz pierwszy będziesz mógł się zalogować na nowo utworzone konto.</p>
                    <a class="button mt-4 mb-4" href="login_page.php">ZALOGUJ SIĘ</a>
                </div>
            </div> 
        </div>
        <!-- End Of Main -->
        
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>