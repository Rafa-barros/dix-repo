<?php

namespace App\Models;

use App\Models\chatModel;
use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";
$chatMsg = new chatModel();
if($_POST['funcao'] == "novoChat"){
	$res = $chatMsg->novoChat($_POST['username']);
}else if($_POST['funcao'] == "carregarMensagens"){
	$res = $chatMsg->carregarMensagens($_POST['username']);
}

echo json_encode((array(
    'username' => "",
    'funcao' => "",
    'mensagens' => $res
)));