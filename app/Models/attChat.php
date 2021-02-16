<?php

namespace App\Models;

use App\Models\chatModel;
use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";
$chatMsg = new chatModel();
$result = $chatMsg->verificarNewMsg($_POST['mensagem'], $_POST['username'], $_POST['msgDate'])

echo json_encode((array(
    'username' => "",
    'mensagem' => "",
    'msgDate' => "",
    'newMsg' => $result
)));