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
		$bio = isset($_POST["bio"]) ? $_POST["bio"] : "";
	}

}