<?php

namespace App\Controller;

use App\Models\chat;

class Chat {
    public function index(){
    	$chat = new chat();
        require("App/View/feed/chat.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/chat.css'>");
    }
}

