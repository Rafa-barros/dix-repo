<?php

namespace App\Controller;

use App\Models\registroUsuario;

class Cadastro {
    public function index(){
        if(isset($_POST['submit'])){
            $cadastro = new registroUsuario();
            if($cadastro->verifyFields($_POST['email'], $_POST['pwd'], $_POST['confirmPwd'])){
                $idVerify = $cadastro->newUser($_POST['email'], $_POST['pwd'], $_POST['username'], $_POST['dia'], $_POST['mes'], $_POST['ano'] , $_POST['pname']);
                echo $idVerify;
                // if($idVerify != FALSE){
                //     echo '<script type="text/javascript">window.location.href="http://dix.net.br/Verificarconta?id=' . $idVerify . '&email=' . $_POST['email'] . '"</script>';
                //     die();
                // }
            }
        }
        require('app/View/login/cadastro.php');
    }

    public function carregarCSS() {
        echo("<link rel='stylesheet' href='app/View/assets/css/cadastro.css'>");
    }
}

?>
