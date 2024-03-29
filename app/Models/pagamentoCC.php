<?php

namespace App\Models;
use App\Models\Database;

use PDO;

class PagamentoCC {
    private $conn;
    private $receiver;
    private $params;
    public $key;
    public $id;
    public $retornoPag;

    public function __construct(){
        $this->conn = new Database();
        $resultToken = $this->conn->executeQuery('SELECT id, chave FROM uHe0b4W', array());
        $resultToken = $resultToken->fetch();
        $this->id = $resultToken['id'];
        $this->key = $resultToken['chave'];

        $receiverDB = $this->conn->executeQuery('SELECT * FROM mVf2Ca6 WHERE 1 = 1', array());
        $this->receiver = $receiverDB->fetch(PDO::FETCH_ASSOC);
    }

    private function cripto_ssl($text) {
        $encrypt_method = "AES-256-CBC";
        $secret_key = '9ccf0060e4b92f6d803367d940a2f61e0be2040d97b98c1e6134a4d78edc76d8';
        $salt = '00c4a240956cf121a244b2e0a1bc82f0';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $salt), 0, 16);
        $output = openssl_encrypt($text, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    public function callAPI($url, $params){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/vnd.pagseguro.com.br.v3+xml', 'Content-Type: application/x-www-form-urlencoded'));
        $resultado = curl_exec($curl);
        $session = simplexml_load_string($resultado);
        
        return $session;
    }

    public function getParams($user, $amount, $nomeTitular, $email, $sHash, $rua, $nLocal, $complemento, $bairro, $cep, $cidade, $estado, $tkCard, $cpfTitular, $nascimento, $dddTel, $nTelefone){
        $this->params = array (
            "payment.mode" => "default",
            "payment.method" => "creditCard",
            "currency" => "BRL",
            "item[1].id" => "000",
            "item[1].description" => ("Pagamento no Dix para: " . (htmlentities($user))),
            "item[1].amount" => (htmlentities($amount)),
            "item[1].quantity" => "1",
            "notificationURL" => "dix.net.br/notificacaoPS",
            "reference" => "dix",
            "sender.name" => (htmlentities($nomeTitular)),
            "sender.CPF" => (htmlentities($cpfTitular)),
            "sender.areaCode" => (htmlentities($dddTel)),
            "sender.phone" => (htmlentities($nTelefone)),
            "sender.email" => (htmlentities($email)),
            "sender.hash" => (htmlentities($sHash)),
            "shipping.address.street" => (htmlentities($rua)),
            "shipping.address.number" => (htmlentities($nLocal)),
            "shipping.address.complement" => (htmlentities($rua)),
            "shipping.address.district" => (htmlentities($bairro)),
            "shipping.address.postalCode" => (htmlentities($cep)),
            "shipping.address.city" => (htmlentities($cidade)),
            "shipping.address.state" => (htmlentities($estado)),
            "shipping.address.country" => "BRA",
            "shipping.type" => "3",
            "shipping.cost" => "0.00",
            "installment.quantity" => "1",
            "installment.value" => (htmlentities($amount)),
            "installment.noInterestInstallmentQuantity" => "2",
            "creditCard.token" => (htmlentities($tkCard)),
            "creditCard.holder.name" => (htmlentities($nomeTitular)),
            "creditCard.holder.CPF" => (htmlentities($cpfTitular)),
            "creditCard.holder.birthDate" => (htmlentities($nascimento)),
            "creditCard.holder.areaCode" => (htmlentities($dddTel)),
            "creditCard.holder.phone" => (htmlentities($nTelefone)),
            "billingAddress.street" => "Rua Santa Maria Rossello",
            "billingAddress.number" => "180",
            "billingAddress.complement" => "Apt. 607",
            "billingAddress.district" => "Mansoes Santo Antônio",
            "billingAddress.postalCode" => "13087503",
            "billingAddress.city" => "Campinas",
            "billingAddress.state" => "SP",
            "billingAddress.country" => "BRA"
        );
    }
    
    public function pagar(){
        $urlPagamento = "https://ws.pagseguro.uol.com.br/transactions?appId=" . $this->id . "&appKey=" . $this->key;
        $retorno = $this->callAPI($urlPagamento, $this->params);

        if ($retorno['code'] != '0'){
            $this->retornoPag = "<div style='display: none' id='cond'>SUCESSO</div>";
        
            //Result user
            $result = $this->conn->executeQuery('SELECT id, username FROM users WHERE email = :EMAIL', array(
                ':EMAIL' => (base64_decode($_COOKIE['cUser']))
            ));
            $result = $result->fetch();
            $idUser = $result['id'];
        
            //Insere a transação na DB
            if (isset($_GET['idPost'])) {
                $this->conn->executeQuery('INSERT INTO assoc_posts (id, idFollower, transacao) VALUES (:ID, :IDUSER, :TRANS)', array(
                    ':ID' => (htmlentities($_GET['idPost'])),
                    ':IDUSER' => $idUser,
                    ':TRANS' => $retorno['code']
                ));

                $resultIdOp = $this->conn->executeQuery('SELECT idUser FROM posts WHERE id = :ID', array(
                    ':ID' => (htmlentities($_GET['idPost']))
                ));
                $resultIdOp = $resultIdOp->fetch();
                $idOp = $resultIdOp['0'];
            } else {
                $resultIdOp = $this->conn->executeQuery('SELECT id FROM users WHERE username = :USER', array(
                    ':USER' => htmlentities($_GET['user'])
                ));
                $resultIdOp = $resultIdOp->fetch();
                $idOp = $resultIdOp['0'];
                if (isset($_GET['vip'])){
                    $this->conn->executeQuery('INSERT INTO assoc_users_vips (id, idFollower, dataVip, transacao) VALUES (:ID, :IDUSER, :DATAHJ, :TRANS)', array(
                        ':ID' => htmlentities($_GET['user']),
                        ':IDUSER' => $idUser,
                        ':DATAHJ' => date('Y-m-d'),
                        ':TRANS' => $retorno['code']
                    ));
                } else {
                    //Envia a Notificação de Gorjeta
                    $this->conn->executeQuery('INSERT INTO notifications (idReceiver, type, amount, msg, username, jaVisto) VALUES (:ID, 2, :AMOUNT, :MSG, :USER, 0)', array(
                        ':ID' => $idOp,
                        ':AMOUNT' => htmlentities($_GET['amount']),
                        ':MSG' => htmlentities(urldecode($_GET['msg'])),
                        ':USER' => $result['username']
                    ));
                }
            }

            //Envia o ganho para a pessoa
            $resultPercent = $this->conn->executeQuery('SELECT porcentagem FROM uHe0b4W', array());
            $resultPercent = $resultPercent->fetch();
            $percent = $resultPercent['0'];

            $this->conn->executeQuery('UPDATE infobancarias SET ganhos = ganhos + :AMOUNT WHERE id = :ID', array(
                ':AMOUNT' => ($_GET['amount'] - (($_GET['amount'] * $percent)/100)),
                ':ID' => $idOp
            ));

            //Envia o lucro para o site
            $this->conn->executeQuery('UPDATE uHe0b4W SET lucro = lucro + :AMOUNT', array(
                ':AMOUNT' => (($_GET['amount'] * $percent)/100)
            ));
        
            //Salva o cartão encriptografado
            if (isset($_POST['salvar'])){
                $this->conn->executeQuery('INSERT INTO cartoes (holder, cpf, birthDate, areaCode, phone, nCard, cvv, monthVal, yearVal, brand, emailOwner) VALUES (
                    :NOMETITULAR,
                    :CPF,
                    :BIRTHDATE,
                    :DDD,
                    :TEL,
                    :NCARD,
                    :CVV,
                    :MONTHVAL,
                    :YEARVAL,
                    :BRAND,
                    :EMAIL
                )', array(
                    ':NOMETITULAR' => (htmlentities($_POST['nomeTitular'])),
                    ':CPF' => (cripto_ssl(htmlentities($_POST['cpfTitular']))),
                    ':BIRTHDATE' => (cripto_ssl(htmlentities($_POST['nascimento']))),
                    ':DDD' => (cripto_ssl(htmlentities($_POST['dddTel']))),
                    ':TEL' => (cripto_ssl(htmlentities($_POST['numeroTelefone']))),
                    ':NCARD' => (cripto_ssl(htmlentities($_POST['nCartao']))),
                    ':CVV' => (cripto_ssl(htmlentities($_POST['cvv']))),
                    ':MONTHVAL' => (cripto_ssl(htmlentities($_POST['monthVal']))),
                    ':YEARVAL' => (cripto_ssl(htmlentities($_POST['yearVal']))),
                    ':BRAND' => (cripto_ssl(htmlentities($_POST['brand']))),
                    ':EMAIL' => (cripto_ssl(htmlentities($_COOKIE['cUser'])))
                ));
            }
        } else {
            $this->retornoPag = "<h2 id='cond'>ERRO: " . var_dump($this->params) . "<br>" . var_dump($retorno) . "</h2>";
        }
    }
}

?>