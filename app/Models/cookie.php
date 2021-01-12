<?php

namespace App\Models;

class cookie{

	/*Essa função deve ser chamada para setar os cookies de login, para que a pessoa permaneça logada, ela utiliza o email da pessoa como parâmetro.
	Ela funciona gerando um número aleatório, e depois adicionando um hash MD5 à esse número utilizando o email da pessoa como hash, esse é o token da pessoa, então esse hash é armazenado no banco de dados como o token da pessoa.
	Após isso, são setados 2 cookies, um com o token da pessoa e outro com o email do usuário em BASE64.
	Os 2 cookies funcionarão juntos para a verificação de que o usuário está logado, e que de fato é ele que está logando.
	Caso a pessoa não entre novamente dentro de 30 dias, os cookies irão expirar, e ela precisará fazer login novamente.
	*/
	public function newCookie($email){
		$new = rand(100000, 10000000000000);
		$token = md5($new . $email);
		$conn = new Database();
		$conn->executeQuery('UPDATE users SET token = :TOKEN WHERE email = :EMAIL', array(
			':TOKEN' => $token,
			':EMAIL' => $email
		));
		setcookie('token', $token, time() + (30 * 24 * 60 * 60));
		setcookie('cUser', base64_encode($email), time() + (30 * 24 * 60 * 60));
	}

	/*Essa função verifica se os cookies setados no computador da pessoa, batem com o banco de dados. Caso esteja tudo certo, a função retornará TRUE, caso contrário retornará FALSE.
	*/
	public function verifyCookie($token, $cUser){
		$email = base64_decode($cUser);
		$conn = new Database();
		$result = $conn->executeQuery('SELECT email, token FROM users WHERE email = :EMAIL AND token = :TOKEN LIMIT 1', array(
			':USER' => $email,
			':TOKEN' => $token
		));
		$res = $result->fetch();
		return !empty($res);
	}

	/*Essa função deve ser chamada quando o usuário realizar LOGOUT, a função irá retirar o token do banco de dados e apagar os cookies do computador do usuário
	*/
	public function deleteCookie($email){
		$conn = new Database();
		$conn->executeQuery('UPDATE users SET token = NULL WHERE email = :EMAIL', array(
			':EMAIL' => $email
		));
		setcookie('token', null, -1, '/');
		setcookie('cUser', null, -1, '/');
	}

}

?>