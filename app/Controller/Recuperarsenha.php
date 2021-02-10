<?php

namespace App\Controller;

class Recuperarsenha {
    public function index(){
        require("app/View/login/recuperarSenha.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/recuperarSenha.css'>");
    }
}

