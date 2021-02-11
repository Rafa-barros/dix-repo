<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

class Notificacao {
	public $email;
	private $idUser;
	private $conn;

	public function __construct(){
		$this->conn = new Database();
	}

	public function getNotifications(){
		//Encontra o id do usuário
        $resultIdUser = $this->conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
            ':EMAIL' => $this->email
        ));
        $resultIdUser = $resultIdUser->fetch();
        $this->idUser = $resultIdUser['0'];

        
	}
}