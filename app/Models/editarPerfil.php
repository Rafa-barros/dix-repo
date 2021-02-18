<?php

namespace App\Models;

use App\Models\Database;
use App\Models\uploadMedia;

class alterarPerfil {

	private $userId;
	private $conn;
	private $email;

	private function getId(){
		$this->email = base64_decode($_COOKIE['cUser']);
		$id = $this->conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
			':EMAIL' => $this->email
		));
		$id = $id->fetch();
		$this->userId = $id['id'];
	}

	public function __construct(){
		$this->conn = new Database();
		$this->getId();
	}

	public function editarPerfil(){
		$description = isset($_POST["description"]) ? $_POST["description"] : "";
		if($description != ""){
			$this->conn->executeQuery('UPDATE users SET description = :DESCRIPTION WHERE id = :ID', array(
				':DESCRIPTION' => $description,
				':ID' => $this->userId
			));
		}
		$bio = isset($_POST["bio"]) ? $_POST["bio"] : "";
		if($bio != ""){
			$this->conn->executeQuery('UPDATE users SET bio = :BIO WHERE id = :ID', array(
				':BIO' => $bio,
				':ID' => $this->userId
			));
		}
		if(isset($_POST['arquivo'])){
			$userImg = new uploadMedia();
			$userImg->uploadUserImg();
		}
		if(isset($_POST['capa'])){
			$userImg = new uploadMedia();
			$userImg->uploadUserCapa();
		}
	}

	public function configuracoes(){
		$username = isset($_POST["username"]) ? $_POST["username"] : "";
		if($username != ""){
			$this->conn->executeQuery('UPDATE users SET username = :USERNAME WHERE id = :ID', array(
				':USERNAME' => $username,
				':ID' => $this->userId
			));
		}
		if(isset($_POST['dia']) && isset($_POST['mes']) && isset($_POST['ano'])){
			$nascimento = $_POST['ano'] . '-' . $_POST['mes'] . '-' . $_POST['dia'];
			$this->conn->executeQuery('UPDATE users SET birth = :BIRTH WHERE id = :ID', array(
				':BIRTH' => $nascimento,
				':ID' => $this->userId
			));
		}
		$cpf = isset($_POST["cpf"]) ? $_POST["cpf"] : "";
		if($cpf != ""){
			$this->conn->executeQuery('UPDATE infobancarias SET cpf = :CPF WHERE id = :ID', array(
				':CPF' => $cpf,
				':ID' => $this->userId
			));
		}
		
	}

}