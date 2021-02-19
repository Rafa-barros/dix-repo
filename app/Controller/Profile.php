<?php

namespace App\Controller;

class Profile {
    public $urlMetodo;

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

        require("app/Models/alterarPerfil.php");
        if(isset($_POST['editar'])){
            $editar = new \app\Models\alterarPerfil();
            if(isset($_FILES['arquivo'])){
                $editar->alterarImgPerfil();
            }
            if(isset($_FILES['capa'])){
                $editar->alterarImgCapa();
            }
            $editar->editarPerfil();
            header('Location: https://dix.net.br/profile/' . $user, true, 303);
            die();
        }

        if(isset($_POST['config'])){
            $config = new \app\Models\alterarPerfil();
            $config->configuracoes();
            header('Location: https://dix.net.br/profile/' . $user, true, 303);
            die();
        }
        
        echo ("<script>var dataUser =" . $notification->idUser . ";" . "</script>");

        //Pega as info's do perfil
        require("app/Models/getProfile.php");
        
        $usuario = new \app\Models\ProfileModel();
        $usuario->username = $this->urlMetodo;
        $usuario->getInfo();
        $jaSegue = $usuario->checaFollower($notification->idUser);
        $vipSalvo = $usuario->checaVIP($notification->idUser);

        //Insere os posts
        require("app/Models/getProfilePosts.php");
        $profilePosts = new \app\Models\ProfilePosts();
        $profilePosts->userOp = $usuario->username;
        $profilePosts->getInfo();
        $profilePosts->selPost();

        if (empty($usuario->profileInfo['id'])){
            require ("app/View/other/error404.php");
        } else {
            $id = $usuario->profileInfo['id'];
            $descript = $usuario->profileInfo['description'];
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