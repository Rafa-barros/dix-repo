<?php

namespace App\Controller;

use App\Models\novaSenha;

class Recuperarsenha {
    public function index(){
    	$recuperar = new novaSenha();
        if(isset($_POST['pwd']) && isset($_POST['confirmPwd'])){
            $result = $recuperar->alterarSenha($_POST['pwd'], $_POST['confirmPwd']);
            // if($result == TRUE){
            //     header("Location: http://dix.net.br");
            // }
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
    		$result = $recuperar->insertEmail($_POST['email']);
            if($result == TRUE){
                header("Location: http://dix.net.br/recuperarsenha?id=" . $_SESSION['newId'] . "&email=" . $_POST['email']);
                unset($_SESSION['newId']);
            }
    	}
        require("app/View/login/recuperarSenha.php");
    }

    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/recuperarSenha.css'>");
    }
}

