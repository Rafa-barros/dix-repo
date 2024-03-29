<?php

namespace App\Models;

use App\Models\Database;

class uploadMedia{

	private $email;
	private $userId;
	private $nPosts;
	private $conn;

	private function getUserId(){
		$this->email = base64_decode($_COOKIE['cUser']);
		$result = $this->conn->executeQuery('SELECT id, idPosts FROM users WHERE email = :EMAIL', array(
			':EMAIL' => $this->email
		));
		$result = $result->fetch();
		$this->userId = $result['id'];
		$this->nPosts = $result['idPosts'];
	}

	public function __construct(){
		$this->conn = new Database();
		$this->getUserId();
	}

	public function uploadPostMedia(){

		if(isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK){
			$fileTmpPath = $_FILES['arquivo']['tmp_name'];//Nome temporário que o arquivo recebe
			$fileName = $_FILES['arquivo']['name'];//Nome do arquivo no computador da pessoa
			$fileSize = $_FILES['arquivo']['size'];//Tamanho do arquivo em bytes
			$fileType = $_FILES['arquivo']['type'];//Tipo do arquivo

			//Separa o nome do arquivo da extensão
			$fileNameCmps = explode(".", $fileName);

			//Armazena a extensão do arquivo em uma variável
			$fileExtension = strtolower(end($fileNameCmps));

			//Novo nome que o arquivo vai receber ao ser armazenado no servidor
			$newFileName = md5($this->email . $this->nPosts) . '.' . $fileExtension;

			//Lista de extensões permitidas para a foto de perfil
			$allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'webp');

			//Verifica se a extensão do arquivo que a pessoa fez upload, está dentro das extensões permitidas
			if(in_array($fileExtension, $allowedfileExtensions)){

				$uploadFileDir = 'media/';
				$dest_path = $uploadFileDir . $newFileName;

				if(move_uploaded_file($fileTmpPath, $dest_path)){
					return $dest_path;

				}else{

					$_SESSION['erro'] = TRUE;
					return 0;

				}
			}else{

				$_SESSION['erro'] = TRUE;
				return 0;

			}
		}else{

			$_SESSION['erro'] = TRUE;
			return 0;

		}

	}

	public function uploadUserImg(){

		//Verifica se recebeu um arquivo para atualizar a foto de perfil, e se não houve nenhum erro
		if(isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK){

			$fileTmpPath = $_FILES['arquivo']['tmp_name'];//Nome temporário que o arquivo recebe
			$fileName = $_FILES['arquivo']['name'];//Nome do arquivo no computador da pessoa
			$fileSize = $_FILES['arquivo']['size'];//Tamanho do arquivo em bytes
			$fileType = $_FILES['arquivo']['type'];//Tipo do arquivo

			//Separa o nome do arquivo da extensão
			$fileNameCmps = explode(".", $fileName);

			//Armazena a extensão do arquivo em uma variável
			$fileExtension = strtolower(end($fileNameCmps));

			//Novo nome que o arquivo vai receber ao ser armazenado no servidor
			$newFileName = md5($this->email) . '.' . $fileExtension;

			//Lista de extensões permitidas para a foto de perfil
			$allowedfileExtensions = array('jpg', 'jpeg', 'png');

			//Verifica se a extensão do arquivo que a pessoa fez upload, está dentro das extensões permitidas
			if(in_array($fileExtension, $allowedfileExtensions)){

				$uploadFileDir = 'userImages/';
				$dest_path = $uploadFileDir . $newFileName;

				if(move_uploaded_file($fileTmpPath, $dest_path)){

					$result = $this->conn->executeQuery('UPDATE users SET imgUser = :PATHIMG WHERE id = :EMAIL', array(
						':PATHIMG' => $dest_path,
						':EMAIL' => $this->userId
					));
					return TRUE;

				}else{

					//Caso ocorra algum erro na hora de salvar a nova foto de perfil, será definida a variável de sessão 'erro', e a pessoa voltará para a página inicial
					$_SESSION['erro'] = TRUE;
					return TRUE;

				}
			}else{

				//Caso o arquivo que a pessoa enviou não tenha uma extensão permitida, será definida a variável de sessão 'erro', e a pessoa voltará para a página inicial
				$_SESSION['erro'] = TRUE;
				return TRUE;

			}
		}else{

			//Caso a pessoa não tenha enviado nenhum arquivo, será definida a variável de sessão 'erro', e a pessoa voltará para a página inicial
			$_SESSION['erro'] = TRUE;
			return FALSE;

		}

	}

	public function uploadUserCapa(){

		//Verifica se recebeu um arquivo para atualizar a foto de perfil, e se não houve nenhum erro
		if(isset($_FILES['capa']) && $_FILES['capa']['error'] === UPLOAD_ERR_OK){

			$fileTmpPath = $_FILES['capa']['tmp_name'];//Nome temporário que o arquivo recebe
			$fileName = $_FILES['capa']['name'];//Nome do arquivo no computador da pessoa
			$fileSize = $_FILES['capa']['size'];//Tamanho do arquivo em bytes
			$fileType = $_FILES['capa']['type'];//Tipo do arquivo

			//Separa o nome do arquivo da extensão
			$fileNameCmps = explode(".", $fileName);

			//Armazena a extensão do arquivo em uma variável
			$fileExtension = strtolower(end($fileNameCmps));

			//Novo nome que o arquivo vai receber ao ser armazenado no servidor
			$newFileName = md5('capa' . $this->email) . '.' . $fileExtension;

			//Lista de extensões permitidas para a foto de perfil
			$allowedfileExtensions = array('jpg', 'jpeg', 'png');

			//Verifica se a extensão do arquivo que a pessoa fez upload, está dentro das extensões permitidas
			if(in_array($fileExtension, $allowedfileExtensions)){

				$uploadFileDir = 'userImages/';
				$dest_path = $uploadFileDir . $newFileName;

				if(move_uploaded_file($fileTmpPath, $dest_path)){

					$result = $this->conn->executeQuery('UPDATE users SET fotoCapa = :PATHIMG WHERE id = :EMAIL', array(
						':PATHIMG' => $dest_path,
						':EMAIL' => $this->userId
					));
					return TRUE;

				}else{

					//Caso ocorra algum erro na hora de salvar a nova foto de perfil, será definida a variável de sessão 'erro', e a pessoa voltará para a página inicial
					$_SESSION['erro'] = TRUE;
					return FALSE;

				}
			}else{

				//Caso o arquivo que a pessoa enviou não tenha uma extensão permitida, será definida a variável de sessão 'erro', e a pessoa voltará para a página inicial
				$_SESSION['erro'] = TRUE;
				return FALSE;

			}
		}else{

			//Caso a pessoa não tenha enviado nenhum arquivo, será definida a variável de sessão 'erro', e a pessoa voltará para a página inicial
			$_SESSION['erro'] = TRUE;
			return FALSE;

		}

	}

}

?>
