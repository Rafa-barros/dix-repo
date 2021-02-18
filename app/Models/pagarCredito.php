<?php

function cripto_ssl($text) 
    {
        $encrypt_method = "AES-256-CBC";
        $secret_key = '9ccf0060e4b92f6d803367d940a2f61e0be2040d97b98c1e6134a4d78edc76d8';
        $salt = '00c4a240956cf121a244b2e0a1bc82f0';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $salt), 0, 16);
        $output = openssl_encrypt($text, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

$receiverDB = $conn->executeQuery('SELECT * FROM mVf2Ca6', array());
$receiver = $receiverDB->fetch(PDO::FETCH_ASSOC);

$parametros = array (
    "payment.mode" => "default",
    "payment.method" => "creditCard",
    "currency" => "BRL",
    "item[1].id" => "000",
    "item[1].description" => ("Pagamento no Dix para: " . (htmlentities($_GET['user']))),
    "item[1].amount" => (htmlentities($_GET['amount'])),
    "item[1].quantity" => "1",
    "notificationURL" => "dix.net.br/notificacao-pagseguro",
    "reference" => "dix",
    "sender.name" => (htmlentities($_POST['nomeTitular'])),
    "sender.CPF" => (htmlentities($_POST['cpfTitular'])),
    "sender.areaCode" => (htmlentities($_POST['dddTel'])),
    "sender.phone" => (htmlentities($_POST['numeroTelefone'])),
    "sender.email" => (htmlentities($_POST['email'])),
    "sender.hash" => (htmlentities($_POST['senderHash'])),
    "shipping.address.street" => (htmlentities($_POST['rua'])),
    "shipping.address.number" => (htmlentities($_POST['nLocal'])),
    "shipping.address.complement" => (htmlentities($_POST['complemento'])),
    "shipping.address.district" => (htmlentities($_POST['bairro'])),
    "shipping.address.postalCode" => (htmlentities($_POST['cep'])),
    "shipping.address.city" => (htmlentities($_POST['cidade'])),
    "shipping.address.state" => (htmlentities($_POST['estado'])),
    "shipping.address.country" => "BRA",
    "shipping.type" => "3",
    "shipping.cost" => "0.00",
    "installment.quantity" => "1",
    "installment.value" => (htmlentities($_POST['price'])),
    "installment.noInterestInstallmentQuantity" => "2",
    "creditCard.token" => (htmlentities($_POST['tokenCard'])),
    "creditCard.holder.name" => (htmlentities($_POST['nomeTitular'])),
    "creditCard.holder.CPF" => (htmlentities($_POST['cpfTitular'])),
    "creditCard.holder.birthDate" => (htmlentities($_POST['nascimento'])),
    "creditCard.holder.areaCode" => (htmlentities($_POST['dddTel'])),
    "creditCard.holder.phone" => (htmlentities($_POST['numeroTelefone'])),
    "billingAddress.street" => "Rua Santa Maria Rossello",
    "billingAddress.number" => "180",
    "billingAddress.complement" => "Apt. 607",
    "billingAddress.district" => "Mansoes Santo Antônio",
    "billingAddress.postalCode" => "13087503",
    "billingAddress.city" => "Campinas",
    "billingAddress.state" => "SP",
    "billingAddress.country" => "BRA",
    "receiver[1].publicKey" => $receiver['publicKey'],
    "receiver[1].split.amount" => $receiver['splitAmount']
);

$url = "https://ws.pagseguro.uol.com.br/transactions?appId=" . $token->id . "&appKey=" . $token->key;
$retorno = callAPI($url, $parametros);

if (strpos($retorno, (htmlentities($_POST['estado']))) !== false){
    echo ("<div style='display: none' id='cond'>SUCESSO</div>");

    //Result user
    $result = $conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
        ':EMAIL' => (htmlentities($_POST['email']))
    ));
    $result = $result->fetch();
    $idUser = $result['0'];

    //Libera o acesso do usuário ao post comprado caso passe do valor
    if (isset($_GET['idPost'])) {
        $resultPricePost = $conn->executeQuery('SELECT price FROM posts WHERE id = :ID', array(
            ':ID' => htmlentities($_GET['idPost'])
        ));
        $resultPricePost = $resultPricePost->fetch();
        $price = $resultPricePost['0'];

        if ($_GET['amount'] >= $price){
            $conn->executeQuery('INSERT INTO assoc_posts (idPost, idUser) VALUES (:POST, :ID)', array(
                ':POST' => (htmlentities($_GET['idPost'])),
                ':ID' => $idUser
            ));
        }
    }

    /*
    AQUI DEVE RODAR O CÓDIGO PARA ELE ENVIAR UMA MENSAGEM AUTOMÁTICA AO COMPRADOR
    */

    //Salva o cartão encriptografado
    if (isset($_POST['salvar'])){
        $conn->executeQuery('INSERT INTO cartoes (holder, cpf, birthDate, areaCode, phone, nCard, cvv, monthVal, yearVal, brand, emailOwner) VALUES (
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
    echo ("<div style='display: none' id='cond'>ERRO: " . $retorno . "</div>");
}

/*
    Tratamento de erros aqui com switch case para cada caso de código

10000	invalid creditcard brand.
10001	creditcard number with invalid length.
10002	invalid date format.
10003	invalid security field.
10004	cvv is mandatory.
10006	security field with invalid length.
53004	items invalid quantity.
53005	currency is required.
53006	currency invalid value: {0}
53007	reference invalid length: {0}
53008	notificationURL invalid length: {0}
53009	notificationURL invalid value: {0}
53010	sender email is required.
53011	sender email invalid length: {0}
53012	sender email invalid value: {0}
53013	sender name is required.
53014	sender name invalid length: {0}
53015	sender name invalid value: {0}
53017	sender cpf invalid value: {0}
53018	sender area code is required.
53019	sender area code invalid value: {0}
53020	sender phone is required.
53021	sender phone invalid value: {0}
53022	shipping address postal code is required.
53023	shipping address postal code invalid value: {0}
53024	shipping address street is required.
53025	shipping address street invalid length: {0}
53026	shipping address number is required.
53027	shipping address number invalid length: {0}
53028	shipping address complement invalid length: {0}
53029	shipping address district is required.
53030	shipping address district invalid length: {0}
53031	shipping address city is required.
53032	shipping address city invalid length: {0}
53033	shipping address state is required.
53034	shipping address state invalid value: {0}
53035	shipping address country is required.
53036	shipping address country invalid length: {0}
53037	credit card token is required.
53038	installment quantity is required.
53039	installment quantity invalid value: {0}
53040	installment value is required.
53041	installment value invalid value: {0}
53042	credit card holder name is required.
53043	credit card holder name invalid length: {0}
53044	credit card holder name invalid value: {0}
53045	credit card holder cpf is required.
53046	credit card holder cpf invalid value: {0}
53047	credit card holder birthdate is required.
53048	credit card holder birthdate invalid value: {0}
53049	credit card holder area code is required.
53050	credit card holder area code invalid value: {0}
53051	credit card holder phone is required.
53052	credit card holder phone invalid value: {0}
53053	billing address postal code is required.
53054	billing address postal code invalid value: {0}
53055	billing address street is required.
53056	billing address street invalid length: {0}
53057	billing address number is required.
53058	billing address number invalid length: {0}
53059	billing address complement invalid length: {0}
53060	billing address district is required.
53061	billing address district invalid length: {0}
53062	billing address city is required.
53063	billing address city invalid length: {0}
53064	billing address state is required.
53065	billing address state invalid value: {0}
53066	billing address country is required.
53067	billing address country invalid length: {0}
53068	receiver email invalid length: {0}
53069	receiver email invalid value: {0}
53070	item id is required.
53071	item id invalid length: {0}
53072	item description is required.
53073	item description invalid length: {0}
53074	item quantity is required.
53075	item quantity out of range: {0}
53076	item quantity invalid value: {0}
53077	item amount is required.
53078	item amount invalid pattern: {0}. Must fit the patern: \d+.\d{2}
53079	item amount out of range: {0}
53081	sender is related to receiver.
53084	invalid receiver: {0}, verify receiver's account status and if it is a seller's account.
53085	payment method unavailable.
53086	cart total amount out of range: {0}
53087	invalid credit card data.
53091	sender hash invalid.
53092	credit card brand is not accepted.
53095	shipping type invalid pattern: {0}
53096	shipping cost invalid pattern: {0}
53097	shipping cost out of range: {0}
53098	cart total value is negative: {0}
53099	extra amount invalid pattern: {0}. Must fit the patern: -?\d+.\d{2}
53101	payment mode invalid value, valid values are default and gateway.
53102	payment method invalid value, valid values are creditCard, boleto e eft.
53104	shipping cost was provided, shipping address must be complete.
53105	sender information was provided, email must be provided too.
53106	credit card holder is incomplete.
53109	shipping address information was provided, sender email must be provided too.
53110	eft bank is required
53111	eft bank is not accepted.
53115	sender born date invalid value: {0}
53117	sender cnpj invalid value: {0}
53122	sender email invalid domain: {0}. You must use an email @sandbox.pagseguro.com.br
53140	installment quantity out of range: {0}. The value must be greater than zero.
53141	sender is blocked.
53142	credit card token invalid.
*/
?>