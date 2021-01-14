<?php

namespace App\Controller;

class Feed {
    public function index(){
        require('App/View/feed/home.php');
    }
}