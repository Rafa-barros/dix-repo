<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$conn = new Database();

//Pega as info's do usuário
$resultInfo = $conn->executeQuery('SELECT username FROM users WHERE email = :EMAIL', array(
    ':EMAIL' => base64_decode($_COOKIE['cUser'])
));
$resultInfo = $resultInfo->fetch();
$username = $resultInfo['0'];

$conn->executeQuery('INSERT INTO comments (username, descript, likes, dateComment, comments, idPost) VALUES (:USER, :DESCR, 0, :DATAC, 0, :IDPOST)', array(
    ':USER' => $username,
    ':DESCR' => htmlentities($_POST['descript']),
    ':DATAC' => (date("Y-m-d H:i:s")),
    ':IDPOST' => htmlentities($_POST['idPost'])
));

$comments = $conn->executeQuery('SELECT comments FROM posts WHERE id = :ID', array(
    ':ID' => htmlentities($_POST['idPost'])
));

$comments = $comments->fetch();
$comments = intval($comments['comments']) + 1;

$conn->executeQuery('UPDATE posts SET comments = :COMMENTS WHERE id = :ID', array(
	':COMMENTS' => $comments,
	':ID' => htmlentities($_POST['idPost'])
));

echo json_encode(array(
    'descript' => 'sucesso',
    'idPost' => htmlentities($_POST['idPost'])
));

?>