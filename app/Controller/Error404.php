<?php

namespace App\Controller;

class Error404 {
    public function index(){
        require("app/View/other/error404.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/error404.css'>");
    }

}