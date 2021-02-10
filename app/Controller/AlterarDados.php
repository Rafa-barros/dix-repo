<?php

namespace App\Controller;

class AlterarDados {
    public function index(){
        require("app/View/login/alterarDados.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/chat.css'>");
    }
}