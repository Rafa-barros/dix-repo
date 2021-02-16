<?php

namespace App\Controller;

use App\Models\Database;
use App\Models\loginUsuario;

class Home {
    public function index(){
    	if(isset($_POST['email']) && isset($_POST['pwd'])){
    		$login = new loginUsuario();
    		$login->Login($_POST['email'], $_POST['pwd']);
            // header("Location: http://dix.net.br");
    	}
        if(isset($_COOKIE['cUser']) && isset($_COOKIE['token'])){
            $email = base64_decode($_COOKIE['cUser']);
            $conn = new Database();
            $result = $conn->executeQuery('SELECT token FROM users WHERE email = :EMAIL', array(
                ':EMAIL' => $email
            ));
            $result = $result->fetch();
            if(!empty($result) && $result['token'] == $_COOKIE['token']){
                header("Location: http://dix.net.br/feed");
                die();
            }
        }
    	require_once("app/Models/facebookAuth.php");
    	require_once("app/Models/googleAuth.php");
        require("app/View/login/index.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/style.css'>");
    }
}