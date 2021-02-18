<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class Notificacao {
	public $email;
	public $qtdNotificacoes;
	public $notificacoesNovas;
	public $notificacoes;
	public $idUser;
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
		$this->notificacoesNovas = 0;
        if(!empty($resultNot)){
	        while ($row = $resultNot->fetch(PDO::FETCH_ASSOC)){
	            $this->notificacoes[$this->qtdNotificacoes] = $row;
				if ($row['jaVisto'] == 0){
					$this->notificacoesNovas++;
				}
				$this->qtdNotificacoes++;
	        }
    	}

		//Limpa as notificações quando passar de 25
		if ($this->qtdNotificacoes >= 25){
			$this->conn->executeQuery('DELETE FROM notifications WHERE idReceiver = :ID', array(
				':ID' => $this->idUser
			));
		}
	}

	public function getProfile(){
		$resultProfile = $this->conn->executeQuery('SELECT username FROM users WHERE id = :ID', array(
			':ID' => $this->idUser
		));
		$resultProfile = $resultProfile->fetch();
		
		return $resultProfile['0'];
	}

	public function getDescript(){
		$resultProfile = $this->conn->executeQuery('SELECT description FROM users WHERE id = :ID', array(
			':ID' => $this->idUser
		));
		$resultProfile = $resultProfile->fetch();
		
		return $resultProfile['0'];
	}
}