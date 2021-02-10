<?php

namespace App\Models;

use App\Models\Database;

class ProfileModel {
    private $conn;
    public $username;
    public $profileInfo;

    public function __construct(){
        $conn = new Database();
    }

    public function getInfo(){
        $resultInfo = $conn->executeQuery('SELECT * FROM users WHERE username = :USER', array(
            ':USER' => $username
        ));
        $this->username = $resultInfo->fetch(PDO::FETCH_ASSOC);
    }
}