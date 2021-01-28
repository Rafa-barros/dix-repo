<?php

namespace App\Models;

use App\Models\Database;

class verificarEmail{

	private $email;
	private $id;
	private $idUser;
	private $codigo;
	private $conn;

	private function getUserId(){
		$result = $conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
			':EMAIL' => $this->email
		));
		$result = $result->fetch();
		$this->userId = $result['id'];
	}

	public function __construct($email){
		$this->email = $email;
		$this->conn = new Database();
		$this->getUserId();
	}

	//Essa função vai remover a linha do ID que acabou de ser utilizado ou que expirou
	private function removerID(){
		$result = $this->conn->executeQuery('DELETE FROM codigoverificacao WHERE id = :ID AND email = :EMAIL', array(
			':ID' => $this->id,
			':EMAIL' => $this->email
		));
	}

	//Essa função vai remover o cadastro de um usuário em que o tempo de verificação já expirou, e depois vai remover o ID dele com a função removerID()
	private function removerCadastro(){
		$result = $this->conn->executeQuery('DELETE FROM users WHERE id = :IDUSER', array(
			':IDUSER' => $this->idUser
		));
		$this->removerID();
	}

	//Essa função vai atualizar o usuário como verificado no banco de dados, e vai chamar a função removerID()
	private function verificado(){
		$result = $this->conn->executeQuery('UPDATE users SET verify = :VERIFY WHERE id = :IDUSER', array(
			':VERIFY' => TRUE,
			':IDUSER' => $this->email
		));
		$this->removerID();
	}

	//Essa função vai conferir no banco de dados se o id do usuário e o código batem, e vai retornar TRUE ou FALSE para a variável de sessão "verificado", caso retorne true vai chamar a função verificado()
	private function verificaCredenciais(){
		$result = $this->conn->executeQuery('SELECT id, email, registerDate, codeAcess FROM codigoverificacao WHERE id = :ID AND codigo = :CODIGO LIMIT 1', array(
			':ID' => $this->id,
			':CODIGO' => $this->codigo
		));
		$res = $result->fetch();
		if(empty($res)){
			return FALSE;
		}else{
			$this->email = $res['email'];
			$datetime1 = new DateTime($res['registerDate']);
			$datetime2 = new DateTime(date('Y-m-d'));
			$interval = $datetime2->diff($datetime1);
			$interval = $interval->format('%a');
			if(intval($interval) > 30){
				$this->removerCadastro();
				return FALSE;
			}else{
				$this->verificado();
				return TRUE;
			}
		}
	}

	public function verify($id, $codigo){
		$this->id = $id;
		$this->codigo = $codigo;
		$verifica = $this->verificaCredenciais();
		return $verifica;
	}

}

?>