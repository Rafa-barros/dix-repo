<?php

namespace App\Models;

session_start();

use App\Models\Database;

require "../../vendor/autoload.php";

function verificaEmail($email){
	$conn = new Database();
	$result = $conn->executeQuery('SELECT email FROM users WHERE email = :EMAIL', array(
		':EMAIL' => $email
	));

	return empty($result);
}

function verificaUsuario($username){
	$conn = new Database();
	$result = $conn->executeQuery('SELECT username FROM users WHERE username = :USER', array(
		':USER' => $username
	));

	return empty($result);
}

function registra($email, $password, $username, $birth, $pname){
	$conn = new Database();
	$result = $conn->executeQuery('INSERT INTO users VALUES (:USER, :PWD, :USERNAME, :BIRTH, :PNAME, :TOKEN, :VERIFY, :TYPEUSER, :POSTS, :IMG, :FOLLOWERS);', array(
		':USER' => $email,
		':PWD' => $pwd,
		':USERNAME' => $username,
		':BIRTH' => $birth,
		':PNAME' => $pname,
		':TOKEN' => NULL,
		':VERIFY' => 0,
		':TYPEUSER' => 0,
		':POSTS' => 0,
		':IMG' => '../../userImages/standard.png',
		':FOLLOWERS' => 0
	));
}

function regCodigo($email){
	$id = rand(1, 1000000000);
	$id = md5($id . $email);
	$codigo = rand(100000, 999999);
	$data = date("Y-m-d");
	$conn = new Database();
	$result = $conn->executeQuery('INSERT INTO codigoverificacao VALUES (:ID, :EMAIL, :DATA, :CODE);', array(
		':ID' => $id,
		':EMAIL' => $email,
		':DATA' => $data,
		':CODE' => $codigo
	));

	if(empty($result)){
		regCodigo($email);
	}else{
		$_SESSION['id'] = $id;
		return TRUE;
	}
}

$email = isset($_POST["email"]) ? $_POST["email"] : "";
$pwd = isset($_POST["pwd"]) ? $_POST["pwd"] : "";
$username = isset($_POST["user"]) ? $_POST["user"] : "";
$dia = isset($_POST["day"]) ? $_POST["day"] : "";
$mes = isset($_POST["month"]) ? $_POST["month"] : "";
$ano = isset($_POST["year"]) ? $_POST["year"] : "";
$pname = isset($_POST["pname"]) ? $_POST["pname"] : $username;

$pwd = md5($pwd . $email);
$birth = $ano . "-" . $mes . "-" . $dia;

if(verificaEmail($email)){
	if(verificaUsuario($username)){
		registra($email, $pwd, $username, $birth, $pname);
		if(regCodigo($email)){
			header("Location: .php?id=" . $_SESSION['id']);
			unset($_SESSION['id']);
			die();
		}
	}else{
		$_SESSION["existeUsuario"] = TRUE;
		header("Location: .php");
		die();
	}
}else{
	$_SESSION["existeEmail"] = TRUE;
	header("Location: .php");
	die();
}

?>