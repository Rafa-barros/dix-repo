<?php

namespace App\Models;

session_start();

use App\Models\Database;

require "../../vendor/autoload.php";

//Essa função vai remover a linha do ID que acabou de ser utilizado ou que expirou
function removerID($email, $id){
	$conn = new Database();
	$result = $conn->executeQuery('DELETE FROM codigoverificacao WHERE id = :ID AND email = :EMAIL', array(
		':ID' => $id,
		':EMAIL' => $email
	));
}

//Essa função vai remover o cadastro de um usuário em que o tempo de verificação já expirou, e depois vai remover o ID dele com a função removerID()
function removerCadastro($email, $id){
	$conn = new Database();
	$result = $conn->executeQuery('DELETE FROM users WHERE email = :EMAIL', array(
		':EMAIL' => $email
	));
	removerID($email, $id);
	unset($_SESSION['email']);
}

//Essa função vai atualizar o usuário como verificado no banco de dados, e vai chamar a função removerID()
function verificado($email, $id){
	$conn = new Database();
	$result = $conn->executeQuery('UPDATE users SET verifyEmail = :VERIFY WHERE email = :EMAIL', array(
		':VERIFY' => TRUE,
		':EMAIL' => $email
	));
	removerID($email, $id);
	unset($_SESSION['email']);
}

//Essa função vai conferir no banco de dados se o id do usuário e o código batem, e vai retornar TRUE ou FALSE para a variável de sessão "verificado", caso retorne true vai chamar a função verificado()
function verificaCredenciais($id, $codigo){
	$conn = new Database();
	$result = $conn->executeQuery('SELECT id, email, dataRegistro, codigo FROM codigoverificacao WHERE id = :ID AND codigo = :CODIGO LIMIT 1', array(
		':ID' => $id,
		':CODIGO' => $codigo
	));
	$res = $result->fetch();
	if(empty($res)){
		return FALSE;
	}else{
		foreach($res as $key => $value){
			if($key == "1"){
				$_SESSION['email'] = $value;
			}else if($key == "2"){
			$datetime1 = new DateTime($value);
			$datetime2 = new DateTime(date('Y-m-d'));
			$interval = $datetime2->diff($datetime1);
			$interval = $interval->format('%a');
			if(intval($interval) > 30){
				removerCadastro($_SESSION['email'], $id);
				return FALSE;
			}else{
				verificado($_SESSION['email'], $id);
				return TRUE;
			}
		}
	}
}

//Essa página vai receber o código e o id do usuário e verificar se estão corretos com a função verificaCredenciais()
if(isset($_GET["id"]) && isset($_POST["codigo"])){
	$_SESSION["verificado"] = verificaCredenciais($_GET["id"], $_POST["codigo"]);
}else{
	header("Location: ../../index.php");
	die();
}

?>