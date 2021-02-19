<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$conn = new Database();

$conn->executeQuery('UPDATE infobancarias SET ganhos = 0.00 WHERE id = :ID', array(
    ':ID' => $_POST['id']
));

echo json_encode(array(
    'id' => 0
));

?>