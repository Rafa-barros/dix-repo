<?php

namespace App\Controller;

use App\Models\Database;


class Feed {
    public function index(){
        /*if(isset($_COOKIE['cUser']) && isset($_COOKIE['token'])){
            $email = base64_decode($_COOKIE['cUser']);
            $conn = new Database();
            $result = $conn->executeQuery('SELECT token FROM users WHERE email = :EMAIL', array(
                ':EMAIL' => $email
            ));
            $result = $result->fetch();
            if(empty($result) || $result['token'] != $_COOKIE['token']){
                header("Location: /");
                die();
            }
        }else{
            header("Location: /");
            die();
        }*/

        //Sistema de Notificações e Perfil
        require("app/Models/loadNotificacao.php");
        $notification = new \app\Models\Notificacao();
        $notification->email = "marvinn2002vcl@gmail.com"; //TROCAR PRA $_COOKIE['cUser']
        $notification->getNotifications();
        $username = $notification->getProfile();
        $notificacoes = $notification->notificacoes;
        $tam = $notification->qtdNotificacoes;

        echo ("<h1>" . $tam . "</h1>");
        echo ("<h1>" . $notificacoes[0]['username'] . "</h1>");
        echo ("<h1>" . $notificacoes['0']['username'] . "</h1>");

        require('app/View/feed/home.php');
        if (isset($_POST['enviar'])){
            require("app/Models/createPost.php");
        }
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/feed.css'>");
    }

}