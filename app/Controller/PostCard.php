<?php

namespace App\Controller;

class PostCard {
    public function index(){
        require('app/View/feed/post-card.php');
    }

    public function carregarCSS() {
        echo("<link rel='stylesheet' href='app/View/assets/css/post-card.css'>");
    }
}