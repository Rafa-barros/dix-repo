<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$idPost = htmlentities($_POST['id']);
$conn = new Database();

//Encontra o id do usuário
$resultIdUser = $conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
    ':EMAIL' => base64_decode($_COOKIE['cUser'])
));
$resultIdUser = $resultIdUser->fetch();
$idUser = $resultIdUser['0'];

$conn->executeQuery('DELETE FROM posts WHERE id = :ID AND idUser = :IDOP', array(
    ':ID' => $idPost,
    ':IDOP' => $idUser
));

echo json_encode(array(
    "id" => 0
));