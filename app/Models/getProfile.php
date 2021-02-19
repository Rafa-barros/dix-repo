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
            ':ID' => $this->profileInfo['id'],
            ':IDFOL' => $id
        ));
        $resultFol = $resultFollower->fetch();
        if (empty($resultFol)){
            return 0;
        } else {
            return 1;
        }
    }

    public function checaVIP($id){
        $resultVIP = $this->conn->executeQuery('SELECT id FROM assoc_users_vips WHERE id = :ID AND idFollower = :IDFOL', array(
            ':ID' => $this->profileInfo['id'],
            ':IDFOL' => $id
        ));
        $resultVIP = $resultVIP->fetch();
        if (empty($resultVIP)){
            return 0;
        } else {
            return 1;
        }
    }
}