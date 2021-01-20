<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class newPost {
    private $conn;
    private $email;
    private $idUser;

    public function __construct(){
        $this->conn = new Database();
    }

    public function getInfo($email){
        $this->email = htmlentities($email);
        $resultIdUser = $this->conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
            ':EMAIL' => $email
        ));
        $resultIdUser = $resultIdUser->fetch();
        $this->idUser = $resultIdUser['0'];

        
    }
}