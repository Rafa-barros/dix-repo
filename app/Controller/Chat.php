<?php

namespace App\Controller;

class Chat {
    public function index(){
        require("App/View/feed/chat.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/chat.css'>");
    }
}

