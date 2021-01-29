<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$idPost = htmlentities($_POST['id']);
$conn = new Database();

$conn->executeQuery('DELETE FROM posts WHERE id = :ID LIMIT 1', array(
    ':ID' => $idPost
));

echo json_encode(array(
    "id" => 0
));