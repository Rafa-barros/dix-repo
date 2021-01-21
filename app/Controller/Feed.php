<?php

namespace App\Controller;

class Feed {
    public function __construct(){
        if (isset($_POST['descriptPost']) && isset($_COOKIE['token']) && isset($_COOKIE['cUser'])){
            require('App/Models/createPost.php');
        }
    }

    public function index(){
        require('App/View/feed/home.php');
    }

    public function carregarCSS(){
        /*
        * ENCAMINHAR UM REQUIRE PARA O CSS DA PÁGINA EM TODO CONTROLADOR
        */
    }
}