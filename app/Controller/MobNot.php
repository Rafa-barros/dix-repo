<?php

namespace App\Controller;

class MobNot {
    public function index(){
    	//$chat = new chatModel();
        require("app/View/feed/MobNot.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/MobNot.css'>");
    }
}