<?php

namespace App\Controller;

class Feed {
    public function __construct(){
        if (isset($_POST['']))
            require('App/Models/newPosts.php');
    }

    public function index(){
        require('App/View/feed/home.php');
    }
}