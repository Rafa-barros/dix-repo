<?php

namespace App\Models;

use App\Models\chatModel;
use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";
$chatMsg = new chatModel();
if(isset($_POST['username']) && isset($_POST['message'])){
	$chatMsg->enviarMensagem($_POST['username'], $_POST['message']);
}

echo json_encode((array(
    'message' => '',
    'username' => ''
)));