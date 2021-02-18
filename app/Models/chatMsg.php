<?php

namespace App\Models;

use App\Models\chatModel;
use App\Models\Database;
use PDO;
use \DateTime;

require "../../vendor/autoload.php";
$chatMsg = new chatModel();
if($_POST['funcao'] == "novoChat"){
	$res = $chatMsg->novoChat($_POST['username']);
}else if($_POST['funcao'] == "carregarMensagens"){
	$res = $chatMsg->carregarMensagens($_POST['username']);
	foreach($res as $key => $value){
		if($key != 0){
			$datetime1 = explode(" ", $res[$key - 1][2]);
			$datetime1 = $datetime1[0];
			$datetime2 = explode(" ", $res[$key][2]);
			$datetime2 = $datetime2[0];
			$interval = strtotime($datetime2) - strtotime($datetime1);
			$interval = floor($interval / (60 * 60 * 24));
			if(intval($interval) > 0){
				$res[$key][3] = 1;
			}
		}
	}
}

echo json_encode((array(
    'username' => "",
    'funcao' => "",
    'mensagens' => $res
)));