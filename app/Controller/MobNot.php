<?php

namespace App\Controller;

class MobNot {
    public function index(){
    	//$chat = new chatModel();
        
        //Sistema de Notificações e Perfil
        require("app/Models/loadNotificacao.php");
        $notification = new \app\Models\Notificacao();
        $notification->email = base64_decode($_COOKIE['cUser']);
        $notification->getNotifications();
        $username = $notification->getProfile();
        $notificacoes = $notification->notificacoes;
        $tam = $notification->qtdNotificacoes;

        echo ("<script>var dataUser =" . $notification->idUser . "</script>");

        require("app/View/feed/MobNot.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/MobNot.css'>");
    }
}
