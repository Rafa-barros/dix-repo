<?php

namespace App\Models;

use App\Models\Database;

$chat = new chatModel();
if($_POST['funcao'] == "novoChat"){
	$res = $chat->novoChat($_POST['username']);
}else if($_POST['funcao'] == "carregarMensagens"){
	$res = $chat->carregarMensagens($_POST['username']);
}

echo json_encode((array(
    'username' => "",
    'funcao' => "",
    'mensagens' => $res
)));