<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$id = htmlentities($_POST['idPost']);

$resultComment = $this->conn->executeQuery('SELECT * FROM comments WHERE idPost = :ID', array(
    ':ID' => $id
));
$i = 0;
while($row = $result->fetch()){
    $comentarios[$i] = $row;
    $i++;
}

for ($k=0; $k<$i; $k++){
    $comentariosJS[$k][2] = $comentarios[$k]['descript'];
    $comentariosJS[$k][3] = $comentarios[$k]['likes'];
    $comentariosJS[$k][4] = $comentarios[$k]['dateComment'];
    $comentariosJS[$k][5] = $comentarios[$k]['comments'];
}

echo json_encode(array (
    'idPost' => $_POST['idPost'],
    'comentarios' => $comentariosJS
));