<?php

namespace App\Controller;

class RedirectInfluencer {
    public function index(){

    	if(isset($_COOKIE['cUser']) && isset($_COOKIE['token'])){
            $email = base64_decode($_COOKIE['cUser']);
            $conn = new Database();
            $result = $conn->executeQuery('SELECT token FROM users WHERE email = :EMAIL', array(
                ':EMAIL' => $email
            ));
            $result = $result->fetch();
            if((empty($result) || $result['token'] != $_COOKIE['token']) || $result['token'] != NULL){
                header("Location: https://dix.net.br");
                die();
            }
        }else{
            header("Location: https://dix.net.br");
            die();
        }
    	
        require("app/View/other/redirectInfluencer.php");
    }

    public function carregarCSS(){
        echo (" ");
    }
}