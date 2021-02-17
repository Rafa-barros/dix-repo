<?php

namespace App\Controller;
use App\Models\Database;

class Pagamento {
    private function decript($text){
        $encrypt_method = "AES-256-CBC";
        $secret_key = '9ccf0060e4b92f6d803367d940a2f61e0be2040d97b98c1e6134a4d78edc76d8';
        $salt = '00c4a240956cf121a244b2e0a1bc82f0';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $salt), 0, 16);
        $output = openssl_decrypt(base64_decode($text), $encrypt_method, $key, 0, $iv);

        return $output;
    }

    public function index(){
        $conn = new Database();
        if (isset($_GET['idPost'])){
            $condPost = $conn->executeQuery('SELECT id FROM posts WHERE id = :ID', array(
                ':ID' => htmlentities($_GET['user'])
            ));
        } else {
            $condUser = $conn->executeQuery('SELECT id FROM users WHERE username = :USER', array(
                ':USER' => htmlentities($_GET['user'])
            ));
            $condUser = $condUser->fetch();
        }
        if (isset($_GET['user']) && isset($_GET['amount']) && ($_GET['amount'] > 1) && (!empty($condUser) || !empty($condPost))){
            require('app/Models/gerarTokenPS.php');
            $token = new \app\Models\Token();
            $url = "https://ws.pagseguro.uol.com.br/sessions";
            $parametros = array (
                "appId" => $token->id,
                "appKey" => $token->key
            );
            $retornoInit = $token->callAPI($url, $parametros);

            //Checa se há uma tentativa de pagamento
            if (isset($_POST['nomeTitular']) && isset($_POST['cpfTitular']) && isset($_POST['dddTel']) && isset($_POST['numeroTelefone']) && isset($_POST['email'])){
                if (isset($_POST['nCartao']) && isset($_POST['cvv']) && isset($_POST['monthVal']) && isset($_POST['yearVal'])){
                    if (isset($_POST['rua']) && isset($_POST['nLocal']) && isset($_POST['bairro']) && isset($_POST['cep']) && isset($_POST['cidade']) && isset($_POST['estado'])){
                        if (isset($_POST['senderHash']) && isset($_POST['brand'])){
                            if (isset($_POST['tokenCard'])){
                                //Verifica se o preço do post condiz
                                if (isset($_GET['idPost'])){
                                    $resultPost = $conn->executeQuery('SELECT price FROM posts WHERE id = :ID', array(
                                        ':ID' => htmlentities($_GET['idPost'])
                                    ));
                                    $resultPost = $resultPost->fetch();
                                    $pricePost = $resultPost['0'];
                                
                                    if ($pricePost == $_GET['amount']){
                                        require('app/Models/pagarCredito.php');
                                    } else {
                                        require("app/View/other/error404.php");
                                        die();
                                    }
                                }
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
            $resultSaved = $conn->executeQuery('SELECT holder FROM cartoes WHERE emailOwner = :EMAIL', array(
                ':EMAIL' => base64_decode($_COOKIE['cUser'])
            ));
            $resultSaved = $resultSaved->fetch();

            if (!(empty($resultSaved))){
                require("app/View/other/btncartaosalvo.php");
            }

            require("app/View/other/pagamento.php");
        } else {
            require("app/View/other/error404.php");
        }
    }
 
    public function carregarCSS(){
        echo ("<link rel='stylesheet' href='app/View/assets/css/pagamento.css'>");
        echo ("<link rel='stylesheet' href='app/View/assets/css/error404.css'>");
    }
}

?>