<?php

namespace App\Controller;

class Feed {

    public function index(){
        require('App/View/feed/home.php');
        if (isset($_POST['enviar'])){
            require("app/Models/createPost.php");
        }
    }

    public function carregarCSS(){
        /*
        * ENCAMINHAR UM REQUIRE PARA O CSS DA PÁGINA EM TODO CONTROLADOR
        */
    }
}