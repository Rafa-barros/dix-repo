<?php

namespace App\Models;

use App\Models\cookie;
use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

$logout = new cookie();
$logout->deleteCookie(base64_decode($_COOKIE['cUser']));

echo json_encode((array(
    'logout' => ''
)));