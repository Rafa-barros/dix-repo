<?php

namespace App\Models;

use App\Models\Database;
use PDO;

$idPost = htmlentities($_POST['id']);
$conn = new Database();

//Encontra o id do usuário
$resultIdUser = $conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
    ':EMAIL' => htmlentities($_COOKIE['cUser'])
));
$resultIdUser = $resultIdUser->fetch();
$idUser = $resultIdUser['0'];

$resultCond = $conn->executeQuery('SELECT idPost FROM assoc_users_likes WHERE idPost = :IDPOST AND idUser = :IDUSER', array(
    ':IDPOST' => $idPost,
    ':IDUSER' => $idUser
));
$resultCond = $resultCond->fetch();

if (!(empty($resultCond))){
    $codigo = 200;
    //Insere o like do usuario no post
    $conn->executeQuery('INSERT INTO assoc_users_likes (idPost, idUser) VALUES (:IDPOST, :IDUSER)', array(
        ':IDPOST' => $idPost,
        ':IDUSER' => $idUser
    ));

    //Adiciona um like
    $conn->executeQuery('UPDATE posts SET likes=likes+1 WHERE id = :ID', array(
        ':ID' => $idPost
    ));
} else {
    $codigo = 201;
    //Remove o like do usuario no post
    $conn->executeQuery('DELETE FROM assoc_users_likes WHERE idPost = :IDPOST AND idUser = :IDUSER', array(
        ':IDPOST' => $idPost,
        ':IDUSER' => $idUser
    ));

    //Diminui um like
    $conn->executeQuery('UPDATE posts SET likes=likes+1 WHERE id = :ID', array(
        ':ID' => $idPost
    ));
}

echo json_encode(array(
    "codigo" => $codigo
));