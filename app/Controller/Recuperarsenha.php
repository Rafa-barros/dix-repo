<?php

namespace App\Controller;

use App\Models\novaSenha;

class Recuperarsenha {
    public function index(){
    	$recuperar = new novaSenha();
        if(isset($_POST['pwd']) && isset($_POST['confirmPwd'])){
            $recuperar->insertEmail($_POST['email']);
        }
    	if(isset($_GET['id'])){
            $_SESSION['id'] = $_GET['id'];
        }
        if(isset($_GET['email'])){
            $_SESSION['email'] = $_GET['email'];
        }
        if(isset($_GET['codigo'])){
            $_SESSION['codigo'] = $_GET['codigo'];
        }
        if(isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['codigo'])){
        	$recuperar->verificaCodigo($_SESSION['id'], $_SESSION['email'], $_SESSION['codigo']);
        }
    	if(isset($_POST['email'])){
    		$recuperar->insertEmail($_POST['email']);
    	}
        require("app/View/login/recuperarSenha.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/recuperarSenha.css'>");
    }
}

