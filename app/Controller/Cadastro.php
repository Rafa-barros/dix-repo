<?php

namespace App\Controller;

class Cadastro {
    public function index(){
        require('App/View/login/cadastro.php');
    }

    public function carregarCSS() {
        echo("<link rel='stylesheet' href='app/View/assets/css/cadastro.css'>");
    }
}