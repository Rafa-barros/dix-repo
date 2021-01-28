<?php

namespace App\Controller;

use App\Models\Database;


class Feed {

    public function index(){
        if(isset($_COOKIE['cUser']) && isset($_COOKIE['token'])){
            $email = base64_decode($_COOKIE['cUser']);
            $conn = new Database();
            $result = $conn->executeQuery('SELECT token FROM users WHERE email = :EMAIL', array(
                ':EMAIL' => $email
            ));
            $result = $result->fetch();
            if(empty($result) || $result['token'] != $_COOKIE['token']){
                header("Location: /");
                die();
            }
        }else{
            header("Location: /");
            die();
        }
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