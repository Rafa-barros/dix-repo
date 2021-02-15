<?php

namespace App\Controller;

class Profile {
    public $urlMetodo;

    public function index(){
        require("app/Models/getProfile.php");
        $usuario = new \app\Models\ProfileModel();
        $usuario->username = $this->urlMetodo;
        $usuario->getInfo();

        if (empty($usuario->profileInfo['id'])){
            require ("app/View/other/error404.php");
        } else {
            $id = $usuario->profileInfo['id'];
            $username = $usuario->profileInfo['username'];
            $birth = $usuario->profileInfo['birth'];
            $pname = htmlentities($usuario->profileInfo['pname']);
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