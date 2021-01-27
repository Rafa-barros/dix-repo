<?php

namespace App\Controller;

class VerificarConta {
    public function index(){
        require("App/View/login/VerificarConta.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/VerificarConta.css'>");
    }
}

