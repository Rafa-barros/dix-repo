<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class ProfileModel {
    private $conn;
    public $username;
    public $profileInfo;

    public function __construct(){
        $this->conn = new Database();
    }

    public function getInfo(){
        $resultInfo = $this->conn->executeQuery('SELECT * FROM users WHERE username = :USER', array(
            ':USER' => $this->username
        ));
        $this->profileInfo = $resultInfo->fetch(PDO::FETCH_ASSOC);
    }

    public function checaFollower($id){
        $resultFollower = $this->conn->executeQuery('SELECT id FROM assoc_users WHERE id = :ID AND idFollower = :IDFOL', array(
            ':ID' => $id,
            ':IDFOL' => $this->profileInfo['id']
        ));
        $resultFol = $resultFollower->fetch();
        if (empty($resultFol)){
            return 0;
        } else {
            return 1;
        }
    }
}