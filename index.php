<?php
    session_start();
    require './vendor/autoload.php';
    $ctrl = new Core\Controller();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Dix</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/assets/img/favicon.ico"/>
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <?php 
            $ctrl->carregarCSS();
        ?>
    </head>
    <body>
    <!-- Variáveis do Javascript pré-inicializadas -->
    <script>
        var postsVistosNav = [];
    </script>
    <?php
        $ctrl->carregar();
    ?>
    </body>
</html>