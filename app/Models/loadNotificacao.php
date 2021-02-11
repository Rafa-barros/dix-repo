<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class Notificacao {
	public $email;
	public $qtdNotificacoes;
	public $notificacoes;
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

		//Query das notificações
		$resultNot = $this->conn->executeQuery("SELECT * FROM notifications WHERE idReceiver = :ID", array(
			':ID' => $this->idUser
		));
        $this->qtdNotificacoes = 0;
        while ($row = $resultNot->fetch(PDO::FETCH_ASSOC)){
            $this->notificacoes[$this->qtdNotificacoes] = $row;
			if ($row['jaVisto'] == 0){
				$this->qtdNotificacoes++;
			}
        }
	}

	public function getProfile(){
		$resultProfile = $this->conn->executeQuery('SELECT username FROM users WHERE id = :ID', array(
			':ID' => $this->idUser
		));
		$resultProfile = $resultProfile->fetch();
		
		return $resultProfile['0'];
	}
}