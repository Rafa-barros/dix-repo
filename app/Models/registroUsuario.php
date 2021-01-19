<?php

namespace App\Models;

use App\Models\Database;

class Registro{

	private $email;
	private $pwd;
	private $username;
	private $pname;
	private $birth;
	private $idVerify;
	private $conn;

	public function __construct(){
		$this->conn = new Database();
	}

	private function verificaEmail($email){
		$result = $this->conn->executeQuery('SELECT email FROM users WHERE email = :EMAIL', array(
			':EMAIL' => $this->email
		));

		return empty($result);
	}

	private function verificaUsuario($username){
		$result = $this->conn->executeQuery('SELECT username FROM users WHERE username = :USER', array(
			':USER' => $this->username
		));

		return empty($result);
	}

	private function registra(){
		$result = $this->conn->executeQuery('INSERT INTO users (email, pwd, username, birth, pname, token, verify, typeuser, posts, imgUser, followers) VALUES (:USER, :PWD, :USERNAME, :BIRTH, :PNAME, :TOKEN, :VERIFY, :TYPEUSER, :POSTS, :IMG, :FOLLOWERS);', array(
			':USER' => $this->email,
			':PWD' => $this->pwd,
			':USERNAME' => $this->username,
			':BIRTH' => $this->birth,
			':PNAME' => $this->pname,
			':TOKEN' => NULL,
			':VERIFY' => 0,
			':TYPEUSER' => 0,
			':POSTS' => 0,
			':IMG' => 'userImages/standard.png',
			':FOLLOWERS' => 0
		));
	}

	private function regCodigo(){
		$this->idVerify = rand(1, 1000000000);
		$this->idVerify = md5($this->idVerify . $this->email);
		$codigo = rand(100000, 999999);
		$data = date("Y-m-d");
		$result = $this->conn->executeQuery('INSERT INTO codigoverificacao VALUES (:ID, :EMAIL, :DATA, :CODE);', array(
			':ID' => $this->idVerify,
			':EMAIL' => $this->email,
			':DATA' => $data,
			':CODE' => $codigo
		));

		if(empty($result)){
			regCodigo();
		}else{
			return TRUE;
		}
	}

	public function newUser($email, $pwd, $username, $dia, $mes, $ano, $pname){
		$this->email = $email;
		$this->pwd = md5($pwd . $email);
		$this->username = $username;
		$this->birth = $ano . "-" . $mes . "-" . $dia;
		$this->pname = $pname;
		if(verificaEmail()){
			if(verificaUsuario()){
				registra();
				if(regCodigo()){
					return $this->idVerify;
				}
			}else{
				$_SESSION["existeUsuario"] = TRUE;
				return FALSE;
			}
		}else{
			$_SESSION["existeEmail"] = TRUE;
			return FALSE;
		}
	}

}

?>