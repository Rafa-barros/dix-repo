<?php

namespace App\Controller;

use App\Models\chatModel;

class Chat {
    public function index(){
        //Sistema de Notificações e Perfil
        require("app/Models/loadNotificacao.php");
        $notification = new \app\Models\Notificacao();
        $notification->email = base64_decode($_COOKIE['cUser']);
        $notification->getNotifications();
        $username = $notification->getProfile();
        $notificacoes = $notification->notificacoes;
        $tam = $notification->qtdNotificacoes;
        
        echo ("<script>var dataUser =" . $notification->idUser . ";" . "</script>");

    	$chat = new chatModel();
        require("app/View/feed/chat.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/chat.css'>");
    }
}