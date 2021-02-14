<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$id = htmlentities($_POST['idPost']);
$conn = new Database();

$resultComment = $conn->executeQuery('SELECT * FROM comments WHERE idPost = :ID', array(
    ':ID' => $id
));
$k = 0;
while($row = $resultComment->fetch(PDO::FETCH_ASSOC)){
    $comentarios[$k][0] = $row['username'];
    $comentarios[$k][1] = $row['descript'];
    $comentarios[$k][2] = $row['likes'];
    $comentarios[$k][3] = $row['dateComment'];
    $comentarios[$k][4] = $row['comments'];
    $k++;
}

echo json_encode(array (
    'idPost' => $_POST['idPost'],
    'comentarios' => $comentariosJS
));