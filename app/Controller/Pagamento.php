<?php

namespace App\Controller;
use App\Models\Database;

class Pagamento {
    public function index(){
        // require('app/Models/gerarTokenPS.php');
        // $url = "https://ws.pagseguro.uol.com.br/sessions";
        // $parametros = array (
        //     "appId" => $id,
        //     "appKey" => $key
        // );
        // $token->callAPI($url, $parametros);
        
        // if (isset($_POST['nomeTitular']) && isset($_POST['cpfTitular']) && isset($_POST['dddTel']) && isset($_POST['numeroTelefone']) && isset($_POST['email'])){
        //     if (isset($_POST['nCartao']) && isset($_POST['cvv']) && isset($_POST['monthVal']) && isset($_POST['yearVal'])){
        //         if (isset($_POST['rua']) && isset($_POST['nLocal']) && isset($_POST['bairro']) && isset($_POST['cep']) && isset($_POST['cidade']) && isset($_POST['estado'])){
        //             if (isset($_POST['senderHash']) && isset($_POST['brand'])){
        //                 if (isset($_POST['tokenCard'])){
        //                     require('app/Models/pagarCredito.php');
        //                 } else {
        //                     echo ("<p>Cartão digitado inválido</p>");
        //                 }
        //             } else {
        //                 echo ("<p>Erro na conexão com o serviço de pagamentos, verifique sua internet e/ou navegador");
        //             }
        //         } else {
        //             echo ("<p>Todos os campos são obrigatórios</p>");
        //         }
        //     } else {
        //         echo ("<p>Os dados do cartão e de cobrança são obrigatórios</p>");
        //     }
        // } else {
        //     echo ("<p>Os dados do comprador, do cartão e de cobrança são obrigatórios</p>");
        // }
        require("App/View/other/pagamento.php");
    }
 
    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/pagamento.css'>");
    }
}

?>