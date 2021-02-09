<?php

namespace App\Controller;
use App\Models\Database;

class Pagamento {
    public function index(){
        if (isset($_GET['user']) && isset($_GET['amount'])){
            $conn = new Database();
            require('app/Models/gerarTokenPS.php');
            $url = "https://ws.pagseguro.uol.com.br/sessions";
            $parametros = array (
                "appId" => $id,
                "appKey" => $key
            );
            $token->callAPI($url, $parametros);

            //Checa se há uma tentativa de pagamento
            if (isset($_POST['nomeTitular']) && isset($_POST['cpfTitular']) && isset($_POST['dddTel']) && isset($_POST['numeroTelefone']) && isset($_POST['email'])){
                if (isset($_POST['nCartao']) && isset($_POST['cvv']) && isset($_POST['monthVal']) && isset($_POST['yearVal'])){
                    if (isset($_POST['rua']) && isset($_POST['nLocal']) && isset($_POST['bairro']) && isset($_POST['cep']) && isset($_POST['cidade']) && isset($_POST['estado'])){
                        if (isset($_POST['senderHash']) && isset($_POST['brand'])){
                            if (isset($_POST['tokenCard'])){
                                require('app/Models/pagarCredito.php');
                            } else {
                                echo ("<p>Cartão digitado inválido</p>");
                            }
                        } else {
                            echo ("<p>Erro na conexão com o serviço de pagamentos, verifique sua internet e/ou navegador");
                        }
                    } else {
                        echo ("<p>Todos os campos são obrigatórios</p>");
                    }
                } else {
                    echo ("<p>Os dados do cartão e de cobrança são obrigatórios</p>");
                }
            } else {
                echo ("<p>Os dados do comprador, do cartão e de cobrança são obrigatórios</p>");
            }

            //Checa se o usuário tem um cartão salvo
            $resultSaved = $conn->executeQuery('SELECT holder FROM cartoes WHERE email = :EMAIL', array(
                ':EMAIL' => (htmlentities($_POST['cUser']))
            ));
            $resultSaved = $resultSaved->fetch();

            if (!(empty($resultSaved))){
                require("app/View/other/btncartaosalvo.php");
            }

            require("app/View/other/pagamento.php");
        }
    }
 
    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/pagamento.css'>");
    }
}

?>