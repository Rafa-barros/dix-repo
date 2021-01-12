<?php

namespace App\Models;

session_start();

use App\Models\Database;
use App\Models\cookie;

require "../../vendor/autoload.php";

//Verifica no banco de dados se o email e a senha batem, e se o email já está verificado. Caso esteja tudo certo retorna TRUE.
function verificaLogin($email, $password){
	$conn = new Database();
	$result = $conn->executeQuery('SELECT email, pwd, verifyEmail FROM users WHERE email = :EMAIL AND pwd = :PWD LIMIT 1', array(
		':EMAIL' => $email,
		':PWD' => $password
	));

	$res = $result->fetch();

	if(empty($res)){
		return FALSE;
	}else{
		foreach($res as $key => $value){
			if($key == "2"){
				if($value == 0){
					return FALSE;
				}else{
					return TRUE;
				}
			}
		}
	}

}

//Recebe o email e senha da página de login
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["pwd"]) ? $_POST["pwd"] : "";

$password = md5($password . $email);

//Se o login retornar TRUE, gera os cookies do usuários e vai para a home, senão gera uma variável de sessão de falha de login e retorna a tela de login
if(verificaLogin($email, $password)){
	$cookie = new cookie();
	$cookie->newCookie($email);
}else{
	$_SESSION["LoginFailed"] == TRUE;
}

?>