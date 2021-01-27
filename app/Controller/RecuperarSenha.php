<?php

namespace App\Controller;

class RecuperarSenha {
    public function index(){
        require("App/View/login/recuperarSenha.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/recuperarSenha.css'>");
    }
}

