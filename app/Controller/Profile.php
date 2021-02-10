<?php

namespace App\Controller;

class Profile {
    public function index(){
        require("app/Models/getProfile.php");
        echo ($this->urlMetodo);
        $usuario = new ProfileModel();
        $usuario->username = $this->urlMetodo;
        $usuario->getInfo();

        if (empty($usuario['id'])){
            //require de uma view de uma pag q não existe
        }
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/profile.css'>");
    }
}