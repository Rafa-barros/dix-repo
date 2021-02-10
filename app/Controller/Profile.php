<?php

namespace App\Controller;

class Profile {
    public function index(){
        echo ($this->urlMetodo);
        //require("app/View/other/profile.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/profile.css'>");
    }
}

