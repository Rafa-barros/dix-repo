<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$idPost = htmlentities($_POST['id']);
$descriptPost = htmlentities($_POST['descript']);
$allowView = htmlentities($_POST['viewAuth']);

$conn = new Database();
$conn->executeQuery('UPDATE post SET descript = :DESC, allowView = :ALVIEW WHERE id = :ID', array(
    ':DESC' => $descriptPost,
    ':ALVIEW' => $allowView,
    ':ID' => $idPost
));

echo json_encode(array(
    'id' => "",
    'descript' => "",
    'viewAuth' => ""
));