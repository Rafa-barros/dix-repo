<?php

namespace App\Models;
use App\Models\Database;

function decript_ssl($text){
    $secret_key = '9ccf0060e4b92f6d803367d940a2f61e0be2040d97b98c1e6134a4d78edc76d8';
    $salt = '00c4a240956cf121a244b2e0a1bc82f0';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $salt), 0, 16);
    return openssl_decrypt(base64_decode($text), "AES-256-CBC", $key, 0, $iv);
}

$cardDB = new Database();

$resultInfo = $cardDB->executeQuery('SELECT * FROM cartoes WHERE emailOwner = :EMAIL', array(
    ':EMAIL' => $_COOKIE['cUser']
));
$userInfo = $resultInfo->fetch(PDO::FETCH_ASSOC);
?>