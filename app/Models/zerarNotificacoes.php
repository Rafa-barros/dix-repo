<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$idUser = base64_decode(htmlentities($_POST['userID']));
$conn = new Database();

$conn->executeQuery('UPDATE notifications SET jaVisto = 1 WHERE idReceiver = :ID', array(
    ':ID' => $idUser
));

echo (json_encode(array(
    'userID' => $idUser
)));

?>