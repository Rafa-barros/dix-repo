<?php

namespace App\Controller;

class Profile {
    public $urlMetodo;

    public function index(){
        require("app/Models/getProfile.php");
        $usuario = new \app\Models\ProfileModel();
        $usuario->username = $this->urlMetodo;
        $usuario->getInfo();

        $id = $usuario->profileInfo['id'];
        $username = $usuario->profileInfo['username'];
        $birth = $usuario->profileInfo['birth'];
        $pname = $usuario->profileInfo['pname'];
        $typeuser = $usuario->profileInfo['typeuser'];
        $posts = $usuario->profileInfo['posts'];
        $img = $usuario->profileInfoo['imgUser'];
        $followers = $usuario->profileInfo['followers'];
        $bio = $usuario->profileInfo['bio'];
        $fotoCapa = $usuario->profileInfo['fotoCapa'];
        $vips = $usuario->profileInfo['vips'];
        require("app/View/other/profile.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/profile.css'>");
    }
}