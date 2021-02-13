<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$conn = new Database();

//Encontra o id do follower
$resultIdUser = $conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
    ':EMAIL' => htmlentities($_POST['email'])
));
$resultIdUser = $resultIdUser->fetch();
$idUser = $resultIdUser['0'];

//Encontra o id do user
$resultUser = $conn->executeQuery('SELECT id FROM users WHERE username = :USERNAME', array(
    ':USERNAME' => htmlentities($_POST['username'])
));
$resultUser = $resultUser->fetch();
$idFlw = $resultUser['0'];

//Adiciona o seguidor no usuário
$conn->executeQuery('INSERT INTO assoc_users (id, idFollower) VALUES (:IDUSER, :IDFLW)', array(
    ':IDUSER' => $idUser,
    ':IDFLW' => $idFlw
));

//Soma um follower na DB
$conn->executeQuery('UPDATE users SET followers=followers+1 WHERE id = :ID', array(
    ':ID' => $idFlw
));

echo json_encode(array(
    'email' => "",
    'username' => ""
));