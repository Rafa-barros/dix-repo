<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$conn = new Database();

//Encontra o id do follower
$resultIdUser = $conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
    ':EMAIL' => base64_decode($_COOKIE['cUser'])
));
$resultIdUser = $resultIdUser->fetch();
$idUser = $resultIdUser['0'];

//Encontra o id do user
$resultUser = $conn->executeQuery('SELECT id, followers FROM users WHERE username = :USERNAME', array(
    ':USERNAME' => htmlentities($_POST['username'])
));
$resultUser = $resultUser->fetch();
$idFlw = $resultUser['id'];

$resultFollower = $conn->executeQuery('SELECT id FROM assoc_users WHERE id = :ID AND idFollower = :IDFOL', array(
    ':ID' => $idFlw,
    ':IDFOL' => $idUser
));

$jaSegue = $resultFollower->fetch();

if (empty($jaSegue)){
    //Adiciona o seguidor no usuário
    $conn->executeQuery('INSERT INTO assoc_users (id, idFollower) VALUES (:IDUSER, :IDFLW)', array(
        ':IDUSER' => $idFlw,
        ':IDFLW' => $idUser
    ));

    //Soma um follower na DB
    $conn->executeQuery('UPDATE users SET followers = followers + 1 WHERE id = :ID', array(
        ':ID' => $idFlw
    ));
} else {
    //Remove o seguidor no usuário
    $conn->executeQuery('DELETE FROM assoc_users WHERE id = :IDUSER AND idFollower = :IDFLW', array(
        ':IDUSER' => $idFlw,
        ':IDFLW' => $idUser
    ));

    //Subtrai um follower na DB
    $conn->executeQuery('UPDATE users SET followers = followers - 1 WHERE id = :ID', array(
        ':ID' => $idFlw
    ));
}

echo json_encode(array(
    'username' => ""
));