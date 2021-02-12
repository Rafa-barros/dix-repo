<?php

namespace App\Controller;

use App\Models\chatModel;
use App\Models\Database;

class Chat {
    public function index(){
    	$chat = new chatModel();
        require("app/View/feed/chat.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/chat.css'>");
    }
}