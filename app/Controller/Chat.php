<?php

namespace App\Controller;

use App\Models\chatModel;

class Chat {
    public function index(){
    	echo base64_decode($_COOKIE['cUser']);
    	$chat = new chatModel();
        require("app/View/feed/chat.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/chat.css'>");
    }
}