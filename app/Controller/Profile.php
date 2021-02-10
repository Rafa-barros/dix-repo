<?php

namespace App\Controller;

class Profile {
    public $urlMetodo;
    public $id;
    public $username;
    public $birth;
    public $pname;
    public $typeuser;
    public $posts;
    public $img;
    public $followers;
    public $bio;

    public function index(){
        require("app/Models/getProfile.php");
        $usuario = new ProfileModel();
        $usuario->username = $this->urlMetodo;
        $usuario->getInfo();

        if (empty($usuario['id'])){
            //require de uma view de uma pag q não existe
        } else {
            $this->id = $usuario['id'];
            $this->username = $usuario['username'];
            $this->birth = $usuario['birth'];
            $this->pname = $usuario['pname'];
            $this->typeuser = $usuario['typeuser'];
            $this->posts = $usuario['posts'];
            $this->img = $usuario['imgUser'];
            $this->followers = $usuario['followers'];
            $this->bio = $usuario['bio'];
            require("app/View/other/profile.php");
        }
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/profile.css'>");
    }
}

$perfil = new Profile();