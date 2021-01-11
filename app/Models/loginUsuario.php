<?php

session_start();
require ('database.php');
require ('cookie.php');

$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["pwd"]) ? $_POST["pwd"] : "";

function verificaLogin($email, $password){

	$conn = new Database();
	$result = $conn->executeQuery('SELECT email, password, verifyEmail FROM  WHERE email = :EMAIL AND password = :PWD LIMIT 1', array(
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

if(verificaLogin($email, $password)){
	$cookie = new cookie();
	$cookie->newCookie($email);
}else{

}

?>