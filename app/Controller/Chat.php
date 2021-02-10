<?php

namespace App\Controller;

use App\Models\chatModel;

class Chat {
    public function index(){
    	//$chat = new chatModel();
        require("app/View/feed/chat.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/chat.css'>");
    }
}