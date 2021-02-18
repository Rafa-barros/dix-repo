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
			$datetime1 = new DateTime($res[$key - 1][2]);
			echo $res[$key - 1][2];
			echo "\n";
			$datetime2 = new DateTime($res[$key][2]);
			echo $res[$key][2];
			echo "\n";
			$interval = $datetime2->diff($datetime1);
			$interval = $interval->format('%a');
			if(intval($interval) > 0){
				$value = 1;
			}
		}
	}
	print_r($res);
}

echo json_encode((array(
    'username' => "",
    'funcao' => "",
    'mensagens' => $res
)));