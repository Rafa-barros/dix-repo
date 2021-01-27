<?php

namespace App\Controller;

class Profile {
    public function index(){
        require("App/View/other/profile.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/profile.css'>");
    }
}

