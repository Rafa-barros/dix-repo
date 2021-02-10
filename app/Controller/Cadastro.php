<?php

namespace App\Controller;

use App\Models\registroUsuario;

class Cadastro {
    public function index(){
        require('app/View/login/cadastro.php');
        if(isset($_POST['submit'])){
            $cadastro = new registroUsuario();
            if($cadastro->verifyFields($_POST['email'], $_POST['pwd'], $_POST['confirmPwd'])){
                $idVerify = $cadastro->newUser($_POST['email'], $_POST['pwd'], $_POST['username'], $_POST['dia'], $_POST['mes'], $_POST['ano'] , $_POST['pname']);
<<<<<<< HEAD
                if($idVerify != FALSE){
                    echo '<script type="text/javascript">window.location.href="http://dix.net.br/verificarconta?id=' . $idVerify . '&email=' . $_POST['email'] . '"</script>';
                    die();
                }
=======
                echo $idVerify;
                // if($idVerify != FALSE){
                //     echo '<script type="text/javascript">window.location.href="http://dix.net.br/Verificarconta?id=' . $idVerify . '&email=' . $_POST['email'] . '"</script>';
                //     die();
                // }
>>>>>>> 55f9b514ba35183d8969aeda2fbb14b4feed5d1b
            }
        }
    }

    public function carregarCSS() {
        echo("<link rel='stylesheet' href='app/View/assets/css/cadastro.css'>");
    }
}

?>
