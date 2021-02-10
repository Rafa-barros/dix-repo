<?php

namespace App\Controller;

class Profile {
    public $urlMetodo;

    public function index(){
        require("app/Models/getProfile.php");
        $usuario = new \app\Models\ProfileModel();
        $usuario->username = $this->urlMetodo;
        $usuario->getInfo();
        echo ($usuario['id']);

            $id = $usuario['id'];
            $username = $usuario['username'];
            $birth = $usuario['birth'];
            $pname = $usuario['pname'];
            $typeuser = $usuario['typeuser'];
            $posts = $usuario['posts'];
            $img = $usuario['imgUser'];
            $followers = $usuario['followers'];
            $bio = $usuario['bio'];
            $fotoCapa = $usuario['fotoCapa'];
            $vips = $usuario['vips'];
            require("app/View/other/profile.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/profile.css'>");
    }
}