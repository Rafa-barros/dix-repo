<?php

namespace App\Models;

use App\Models\Database;
use PDO;

$idPost = $_POST['id'];
$conn = new Database();

//Encontra o id do usuário
$resultIdUser = $conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
    ':EMAIL' => htmlentities($_COOKIE['cUser'])
));
$resultIdUser = $resultIdUser->fetch();
$idUser = $resultIdUser['0'];

