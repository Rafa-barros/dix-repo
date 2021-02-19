<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$idPost = htmlentities($_POST['id']);
$descriptPost = htmlentities($_POST['descript']);
$allowView = htmlentities($_POST['viewAuth']);
$val = htmlentities($_POST['price']);

echo $idPost;
echo $descriptPost;
echo $allowView;
echo $val;

$conn = new Database();

//Encontra o id do usuário
$resultIdUser = $conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
    ':EMAIL' => base64_decode($_COOKIE['cUser'])
));
$resultIdUser = $resultIdUser->fetch();
$idUser = $resultIdUser['id'];

$conn->executeQuery('UPDATE post SET descript = :DESCRIPT WHERE id = :ID AND idUser = :IDOP', array(
    ':DESCRIPT' => $descriptPost,
    ':ID' => $idPost,
    ':IDOP' => $idUser
));

$conn->executeQuery('UPDATE post SET allowView = :ALVIEW WHERE id = :ID AND idUser = :IDOP', array(
    ':ALVIEW' => $allowView,
    ':ID' => $idPost,
    ':IDOP' => $idUser
));

$conn->executeQuery('UPDATE post SET price = :PRICE WHERE id = :ID AND idUser = :IDOP', array(
    ':PRICE' => $val,
    ':ID' => $idPost,
    ':IDOP' => $idUser
));

echo json_encode(array(
    'id' => "",
    'descript' => "",
    'viewAuth' => "",
    'price' => ""
));