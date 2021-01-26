<?php

namespace App\Models;

use App\Models\Database;
use App\Models\loginUsuario;

class registroUsuario{

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

	public function verificaEmail($email){
		$result = $this->conn->executeQuery('SELECT email FROM users WHERE email = :EMAIL', array(
			':EMAIL' => $email
		));

		$result = $result->fetch();

		return empty($result);
	}

	private function verificaUsuario(){
		$result = $this->conn->executeQuery('SELECT username FROM users WHERE username = :USER', array(
			':USER' => $this->username
		));

		return empty($result);
	}

	private function registra(){
		$this->conn->executeQuery('INSERT INTO users (email, pwd, username, birth, pname, token, verify, typeuser, posts, imgUser, followers, idAuth) VALUES (:USER, :PWD, :USERNAME, :BIRTH, :PNAME, :TOKEN, :VERIFY, :TYPEUSER, :POSTS, :IMG, :FOLLOWERS, :IDAUTH);', array(
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
			':FOLLOWERS' => 0,
			':IDAUTH' => 0
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
		if(verificaEmail($email)){
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

	public function newUserAuth($email, $pname, $idAuth){
		if($email != ''){
			$username = md5($email . $pname);
			$username = substr($username, 0, 16);
			$this->conn->executeQuery('INSERT INTO users (email, pwd, username, birth, pname, token, verify, typeuser, posts, imgUser, followers, idAuth) VALUES (:USER, :PWD, :USERNAME, :BIRTH, :PNAME, :TOKEN, :VERIFY, :TYPEUSER, :POSTS, :IMG, :FOLLOWERS, :IDAUTH);', array(
				':USER' => $email,
				':PWD' => NULL,
				':USERNAME' => $username,
				':BIRTH' => "2000-01-01",
				':PNAME' => $pname,
				':TOKEN' => NULL,
				':VERIFY' => 1,
				':TYPEUSER' => 0,
				':POSTS' => 0,
				':IMG' => 'userImages/standard.png',
				':FOLLOWERS' => 0,
				':IDAUTH' => $idAuth
			));
			$login = new loginUsuario();
			$login->loginAuth($email, $idAuth);
		}
	}

}

?>