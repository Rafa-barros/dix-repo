<?php

namespace App\Controller;

class Home {
    public function index(){
        echo ("Teste home");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/style.css'>");
    }
}