<?php

namespace App\Models;

use App\Models\Database;
use App\Models\cookie;

class loginUsuario{

	private $email;
	private $pwd;
	private $conn;

	public function __construct(){
		$this->conn = new Database();
	}

	//Verifica no banco de dados se o email e a senha batem, e se o email já está verificado. Caso esteja tudo certo retorna TRUE.
	private function verificaLogin(){
		$result = $this->conn->executeQuery('SELECT email, pwd, verify FROM users WHERE email = :EMAIL AND pwd = :PWD LIMIT 1', array(
			':EMAIL' => $this->email,
			':PWD' => $this->pwd
		));

		$res = $result->fetch();

		if(empty($res)){
			return FALSE;
		}else{
			if($res['verify'] == 0){
				echo "aaa";
				return FALSE;
			}else{
				return TRUE;
			}
		}

	}

	//Se o login retornar TRUE, gera os cookies do usuários e vai para a home, senão gera uma variável de sessão de falha de login e retorna a tela de login
	public function Login($email, $pwd){
		$this->email = $email;
		$this->pwd = md5($pwd . $email);
		if($this->verificaLogin()){
			$cookie = new cookie();
			$cookie->newCookie($this->email);
		}else{
			$_SESSION['LoginFailed'] = TRUE;
		}
	}

}

?>