<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$idPost = htmlentities($_POST['id']);
$descriptPost = htmlentities($_POST['descript']);
$allowView = htmlentities($_POST['viewAuth']);
$val = htmlentities($_POST['price']);

$conn = new Database();

//Encontra o id do usuário
$resultIdUser = $conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
    ':EMAIL' => base64_decode($_COOKIE['cUser'])
));
$resultIdUser = $resultIdUser->fetch();
$idUser = $resultIdUser['0'];

$conn->executeQuery('UPDATE post SET descript = :DESC, allowView = :ALVIEW, price = :PRICE WHERE id = :ID AND idUser = :IDOP', array(
    ':DESC' => $descriptPost,
    ':ALVIEW' => $allowView,
    ':PRICE' => $val,
    ':ID' => $idPost,
    ':IDOP' => $idUser
));

echo json_encode(array(
    'id' => 0,
    'descript' => "",
    'viewAuth' => "",
    'price' => 0
));