<?php

namespace App\Controller;

use App\Models\Database;


class Feed {
    public function index(){
        
        if(isset($_COOKIE['cUser']) && isset($_COOKIE['token'])){
            $email = base64_decode($_COOKIE['cUser']);
            $conn = new Database();
            $result = $conn->executeQuery('SELECT token FROM users WHERE email = :EMAIL', array(
                ':EMAIL' => $email
            ));
            $result = $result->fetch();
            if((empty($result) || $result['token'] != $_COOKIE['token']) || $result['token'] == NULL){
                header("Location: https://dix.net.br");
                die();
            }
        }else{
            header("Location: https://dix.net.br");
            die();
        }
        
        require("app/Models/loadNotificacao.php");
        $notification = new \app\Models\Notificacao();
        $notification->email = base64_decode($_COOKIE['cUser']);
        $notification->getNotifications();
        $username = $notification->getProfile();
        $notificacoes = $notification->notificacoes;
        $tamNovas = $notification->notificacoesNovas;
        $tam = $notification->qtdNotificacoes;
        
        echo ("<script>var dataUser =" . $notification->idUser . ";" . "</script>");

        require('app/View/feed/home.php');
        if (isset($_POST['enviar'])){
            require("app/Models/createPost.php");
            header('Location: https://dix.net.br/feed', true, 303);
            die();
        }
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/feed.css'>");
    }

}