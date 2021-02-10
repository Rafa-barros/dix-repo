<?php

namespace App\Controller;

use App\Models\verificarEmail;

class Verificarconta {
    public function index(){
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
    		$verificar = new verificarEmail($_SESSION['email']);
    		$result = $verificar->verify($_SESSION['id'], $_SESSION['codigo']);
    		if($result == TRUE){
    			unset($_SESSION['id']);
    			unset($_SESSION['email']);
    			unset($_SESSION['codigo']);
    			header("Location: /");
    			die();
    		}else{
    			unset($_SESSION['id']);
    			unset($_SESSION['email']);
    			unset($_SESSION['codigo']);
    			$_SESSION['erroVerify'] = TRUE;
    		}
    	}
        require("app/View/login/VerificarConta.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/VerificarConta.css'>");
    }
}

