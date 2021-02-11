<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$idUser = base64_decode(htmlentities($_POST['data']));
$conn = new Database();


$conn->executeQuery('DELETE FROM notifications WHERE idReceiver = :ID', array(
    ':ID' => $idUser
));

echo (json_encode(array(
    'data' => "sucesso"
)));

?>