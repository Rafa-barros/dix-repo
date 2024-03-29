<?php
	
namespace App\Models;

use App\Models\Database;
use App\Models\sendEmail;
use \DateTime;

class novaSenha{

	private $idUser;
	private $email;
	private $id;
	private $conn;

	public function __construct(){
		$this->conn = new Database();
	}

	private function getUserId(){
		$result = $this->conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
			':EMAIL' => $_SESSION['email']
		));
		echo $this->email;
		$result = $result->fetch();
		$this->idUser = $result['id'];
	}

	private function updateIDS(){
		$this->conn->executeQuery('DELETE FROM codigoverificacao WHERE id = :ID AND email = :EMAIL', array(
			':ID' => $_SESSION['id'],
			':EMAIL' => $_SESSION['email']
		));
	}

	public function alterarSenha($password, $confirmPwd){
		if($password !== $confirmPwd){
			$_SESSION['senhaDiferente'] = TRUE;
			return FALSE;
		}else{
			$this->getUserId();
			$password = md5($password . $_SESSION['email']);
			$this->conn->executeQuery('UPDATE users SET pwd = :PWD WHERE id = :ID', array(
				':PWD' => $password,
				':ID' => $this->idUser
			));
			$this->updateIDS();
			unset($_SESSION['newPwd']);
			unset($_SESSION['id']);
			unset($_SESSION['email']);
			return TRUE;
		}
	}

	public function verificaCodigo($id, $email, $codigo){
		$this->id = $id;
		$result = $this->conn->executeQuery('SELECT id, email, registerDate, codeAccess FROM codigoverificacao WHERE id = :ID AND email = :EMAIL AND codeAccess = :CODIGO LIMIT 1', array(
			':ID' => $id,
			':EMAIL' => $email,
			':CODIGO' => $codigo
		));
		$result = $result->fetch();
		if(empty($result)){
			$_SESSION['codigoInvalido'] = TRUE;
		}else{
			$datetime1 = new DateTime($result['registerDate']);
			$datetime2 = new DateTime(date('Y-m-d'));
			$interval = $datetime2->diff($datetime1);
			$interval = $interval->format('%a');
			if(intval($interval) > 7){
				$_SESSION['codigoExpirado'] = TRUE;
                unset($_SESSION['codigo']);
				$this->updateIDS();
			}else{
				unset($_SESSION['inserirCodigo']);
                unset($_SESSION['codigo']);
				$_SESSION['newPwd'] = TRUE;
			}
		}
	}

	public function insertEmail($email){
		$result = $this->conn->executeQuery('SELECT * FROM users WHERE email = :EMAIL LIMIT 1', array(
			':EMAIL' => $email
		));
		$result = $result->fetch();
		if(!empty($result)){
			$id = rand(1, 1000000000);
			$id = md5($id . $email);
			$codigo = rand(100000, 999999);
			$data = date("Y-m-d");
			$this->conn->executeQuery('INSERT INTO codigoverificacao VALUES (:ID, :EMAIL, :DATA, :CODE);', array(
				':ID' => $id,
				':EMAIL' => $email,
				':DATA' => $data,
				':CODE' => $codigo
			));
			$_SESSION['inserirCodigo'] = TRUE;
			$mail = new sendEmail();
			$mail->mailSenha($email, $id, $codigo);
			$_SESSION['newId'] = $id;
			return TRUE;
		}else{
			$_SESSION['emailInvalido'] = TRUE;
			return FALSE;
		}
	}

}

?>