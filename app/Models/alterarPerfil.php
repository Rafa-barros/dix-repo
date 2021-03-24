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

	public function alterarImgPerfil(){
		$media = new uploadMedia();
		$media->uploadUserImg();
	}

	public function alterarImgCapa(){
		$media = new uploadMedia();
		$media->uploadUserCapa();
	}

	public function editarPerfil(){
		$description = isset($_POST["description"]) ? $_POST["description"] : "";
		if($description != ""){
			$this->conn->executeQuery('UPDATE users SET description = :DESCRIPTION WHERE id = :ID', array(
				':DESCRIPTION' => $description,
				':ID' => $this->userId
			));
		}
		$pname = isset($_POST["pname"]) ? $_POST["pname"] : "";
		if($pname != ""){
			$this->conn->executeQuery('UPDATE users SET pname = :PNAME WHERE id = :ID', array(
				':PNAME' => $pname,
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
	}

	public function configuracoes(){
		$username = isset($_POST["username"]) ? $_POST["username"] : "";
		$username = strtolower($username);
		if($username != ""){
			$result = $this->conn->executeQuery('SELECT username FROM users WHERE username = :USERNAME', array(
				':USERNAME' => $username
			));
			$result = $result->fetch();
			if(empty($result)){
				$this->conn->executeQuery('UPDATE users SET username = :USERNAME WHERE id = :ID', array(
					':USERNAME' => $username,
					':ID' => $this->userId
				));
			}else{
				$_SESSION['usernameIndisponivel'] = TRUE;
			}
		}
		if(isset($_POST['dia']) && isset($_POST['mes']) && isset($_POST['ano'])){
			$nascimento = $_POST['ano'] . '-' . $_POST['mes'] . '-' . $_POST['dia'];
			$this->conn->executeQuery('UPDATE users SET birth = :BIRTH WHERE id = :ID', array(
				':BIRTH' => $nascimento,
				':ID' => $this->userId
			));
		}

		if (isset($_POST['pix']) || ((isset($_POST['cpf']) && isset($_POST['nBanco']) && isset($_POST['agencia']) && isset($_POST['conta'])))){
			$this->conn->executeQuery('UPDATE users SET influencer = 1 WHERE id = :ID', array(
				':ID' => $this->userId
			));
		}

		$pix = isset($_POST["pix"]) ? $_POST["pix"] : "";
		if($pix != ""){
			$result = $this->conn->executeQuery('SELECT id FROM infobancarias WHERE id = :ID', array(
				':ID' => $this->userId
			));
			$result = $result->fetch();
			if(empty($result)){
				$this->conn->executeQuery('INSERT INTO infobancarias (pix, id) VALUES (:PIX, :ID)', array(
					':PIX' => $pix,
					':ID' => $this->userId
				));
			}else{
				$this->conn->executeQuery('UPDATE infobancarias SET pix = :PIX WHERE id = :ID', array(
					':PIX' => $pix,
					':ID' => $this->userId
				));
			}
		}
		$cpf = isset($_POST["cpf"]) ? $_POST["cpf"] : "";
		if($cpf != ""){
			$result = $this->conn->executeQuery('SELECT id FROM infobancarias WHERE id = :ID', array(
				':ID' => $this->userId
			));
			$result = $result->fetch();
			if(empty($result)){
				$this->conn->executeQuery('INSERT INTO infobancarias (cpf, id) VALUES (:CPF, :ID)', array(
					':CPF' => $cpf,
					':ID' => $this->userId
				));
			}else{
				$this->conn->executeQuery('UPDATE infobancarias SET cpf = :CPF WHERE id = :ID', array(
					':CPF' => $cpf,
					':ID' => $this->userId
				));
			}
		}
		$nBanco = isset($_POST["nBanco"]) ? $_POST["nBanco"] : "";
		if($nBanco != ""){
			$result = $this->conn->executeQuery('SELECT id FROM infobancarias WHERE id = :ID', array(
				':ID' => $this->userId
			));
			$result = $result->fetch();
			if(empty($result)){
				$this->conn->executeQuery('INSERT INTO infobancarias (nBanco, id) VALUES (:NBANCO, :ID)', array(
					':NBANCO' => $nBanco,
					':ID' => $this->userId
				));
			}else{
				$this->conn->executeQuery('UPDATE infobancarias SET nBanco = :NBANCO WHERE id = :ID', array(
					':NBANCO' => $nBanco,
					':ID' => $this->userId
				));
			}
		}
		$agencia = isset($_POST["agencia"]) ? $_POST["agencia"] : "";
		if($agencia != ""){
			$result = $this->conn->executeQuery('SELECT id FROM infobancarias WHERE id = :ID', array(
				':ID' => $this->userId
			));
			$result = $result->fetch();
			if(empty($result)){
				$this->conn->executeQuery('INSERT INTO infobancarias (agencia, id) VALUES (:AGENCIA, :ID)', array(
					':AGENCIA' => $agencia,
					':ID' => $this->userId
				));
			}else{
				$this->conn->executeQuery('UPDATE infobancarias SET agencia = :AGENCIA WHERE id = :ID', array(
					':AGENCIA' => $agencia,
					':ID' => $this->userId
				));
			}
		}
		$conta = isset($_POST["conta"]) ? $_POST["conta"] : "";
		if($conta != ""){
			$result = $this->conn->executeQuery('SELECT id FROM infobancarias WHERE id = :ID', array(
				':ID' => $this->userId
			));
			$result = $result->fetch();
			if(empty($result)){
				$this->conn->executeQuery('INSERT INTO infobancarias (conta, id) VALUES (:CONTA, :ID)', array(
					':CONTA' => $conta,
					':ID' => $this->userId
				));
			}else{
				$this->conn->executeQuery('UPDATE infobancarias SET conta = :CONTA WHERE id = :ID', array(
					':CONTA' => $conta,
					':ID' => $this->userId
				));
			}
		}
	}

}