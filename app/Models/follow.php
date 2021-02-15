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
$followers = intval($resultUser['followers']) + 1;

//Adiciona o seguidor no usuário
$conn->executeQuery('INSERT INTO assoc_users (id, idFollower) VALUES (:IDUSER, :IDFLW)', array(
    ':IDUSER' => $idUser,
    ':IDFLW' => $idFlw
));

//Soma um follower na DB
$conn->executeQuery('UPDATE users SET followers = :FOLLOWERS WHERE id = :ID', array(
	':FOLLOWERS' => $followers,
    ':ID' => $idFlw
));

echo json_encode(array(
    'username' => ""
));