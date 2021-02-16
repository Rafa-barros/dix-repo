<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$conn = new Database();

//Encontra o id do usuário
$resultIdUser = $conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
    ':EMAIL' => base64_decode($_COOKIE['cUser'])
));
$resultIdUser = $resultIdUser->fetch();
$idUser = $resultIdUser['0'];

$conn->executeQuery('UPDATE notifications SET jaVisto = 1 WHERE idReceiver = :ID', array(
    ':ID' => $idUser
));

echo (json_encode(array(
    'codigo' => "200"
)));

?>
