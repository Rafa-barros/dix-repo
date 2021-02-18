<?php

namespace App\Controller;

use App\Models\alterarPerfil;

class Profile {
    public $urlMetodo;

    public function index(){

        if(isset($_POST['editar'])){
            $editar = new alterarPerfil();
            $editar->editarPerfil();
            header('Location: http://dix.net.br/profile', true, 303);
            die();
        }

        if(isset($_POST['config'])){
            $config = new alterarPerfil();
            $config->configuracoes();
            header('Location: http://dix.net.br/profile', true, 303);
            die();
        }

        //Sistema de Notificações e Perfil
        require("app/Models/loadNotificacao.php");
        $notification = new \app\Models\Notificacao();
        $notification->email = base64_decode($_COOKIE['cUser']);
        $notification->getNotifications();
        $username = $notification->getProfile();
        $user = $username;
        $notificacoes = $notification->notificacoes;
        $tamNovas = $notification->notificacoesNovas;
        $tam = $notification->qtdNotificacoes;
        
        echo ("<script>var dataUser =" . $notification->idUser . ";" . "</script>");

        require("app/Models/getProfile.php");
        $usuario = new \app\Models\ProfileModel();
        $usuario->username = $this->urlMetodo;
        $usuario->getInfo();
        $jaSegue = $usuario->checaFollower($notification->idUser);

        if (empty($usuario->profileInfo['id'])){
            require ("app/View/other/error404.php");
        } else {
            $id = $usuario->profileInfo['id'];
            $username = $usuario->profileInfo['username'];
            $birth = $usuario->profileInfo['birth'];
            $pname = $usuario->profileInfo['pname'];
            $typeuser = $usuario->profileInfo['typeuser'];
            $posts = $usuario->profileInfo['posts'];
            $img = ("../" . $usuario->profileInfo['imgUser']);
            $followers = $usuario->profileInfo['followers'];
            $bio = $usuario->profileInfo['bio'];
            $fotoCapa = ("../" . $usuario->profileInfo['fotoCapa']);
            $vips = $usuario->profileInfo['vips'];
            $email = $usuario->profileInfo['email'];
            require("app/View/other/profile.php");
        }
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='../app/View/assets/css/profile.css'>");
        echo ("<link rel='stylesheet' href='../app/View/assets/css/error404.css'>");
    }
}