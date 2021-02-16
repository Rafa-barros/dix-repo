<?php

namespace App\Models;

use App\Models\chatModel;
use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";
$chatMsg = new chatModel();
$result = $chatMsg->attContatos($_POST['chatsCarregados']);

echo json_encode((array(
    'chatsCarregados' => "",
    'newChats' => $result
)));