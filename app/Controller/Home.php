<?php

namespace App\Controller;

class Home {
    public function index(){
    	require("app/Models/facebookAuth.php");
    	require("app/Models/googleAuth.php");
        require("app/View/login/index.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/style.css'>");
    }
}

