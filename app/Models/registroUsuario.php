<?php

session_start();

use App\Models\Database;

require "../../vendor/autoload.php";

function registra($email, $password, $username){
	$conn = new Database();
	$result = $conn->executeQuery('INSERT INTO usuarios VALUES (:USER, :PWD, :USERNAME, :TOKEN, :VERIFY);', array(
		':USER' => $email,
		':PWD' => $password,
		':USERNAME' => $username,
		':TOKEN' => NULL,
		':VERIFY' => 0
	));

	return !empty($result);
}

function regCodigo($email){
	$id = rand(1, 1000000000);
	$id = md5($id . $email);
	$codigo = rand(100000, 999999);
	$data = date("Y-m-d");
	$conn = new Database();
	$result = $conn->executeQuery('INSERT INTO ids VALUES (:ID, :EMAIL, :DATA, :CODE);', array(
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
$username = isset($_POST["user"] ? $_POST["user"] : NULL);

$pwd = md5($pwd . $email);

if(registra($email, $pwd, $username)){
	if(regCodigo($email)){
		header("Location: .php?id=" . $_SESSION['id']);
		unset($_SESSION['id']);
		die();
	}
}else{
	$_SESSION["existe"] = TRUE;
	header("Location: .php");
	die();
}

?>