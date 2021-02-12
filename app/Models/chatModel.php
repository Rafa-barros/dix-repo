<?php

namespace App\Models;

use App\Models\Database;

class chatModel{
	
	private $userId;
	private $email;
	private $idChat;
	private $conn;

	private function getUserId(){
		$this->email = base64_decode($_COOKIE['cUser']);
		$result = $this->conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL LIMIT 1', array(
			':EMAIL' => $this->email
		));
		$result = $result->fetch();
		$this->userId = $result['id'];
	}

	public function __construct(){
		$this->conn = new Database();
		$this->getUserId();
	}

	private function getUserData($id){
		$result = $this->conn->executeQuery('SELECT username, imgUser FROM users WHERE id = :ID LIMIT 1', array(
			':ID' => $id
		));
		$result = $result->fetch();
		return $result;
	}

	private function getId($username){
		$result = $this->conn->executeQuery('SELECT id FROM users WHERE username = :USER LIMIT 1', array(
			':USER' => $username
		));
		$result = $result->fetch();
		return $result['id'];
	}

	private static function date_sort($a, $b){
		return strtotime($a['msgDate']) - strtotime($b['msgDate']);
	}

	public function carregarChats(){
		$result = $this->conn->executeQuery('SELECT id FROM chats WHERE idUser = :ID OR idUser2 = :ID', array(
			':ID' => $this->userId
		));
		$i = 0;
		while($row = $result->fetch()){
			$chats[$i] = $row;
			$i++;
		}
		for($j = 0; $j < $i; $j++){ 
			$res = $this->conn->executeQuery('SELECT * FROM assoc_chats WHERE id = :ID ORDER BY msgDate DESC', array(
				':ID' => $this->$chats[$j]['id']
			));
			$res = $res->fetch();
			if($chats[$j]['idUser'] == $this->userId){
				$data = $this->getUserData($chats[$j]['idUser2']);
				$username = $data['username'];
				$userImg = $data['imgUser'];
			}else{
				$data = $this->getUserData($chats[$j]['idUser']);
				$username = $data['username'];
				$userImg = $data['imgUser'];
			}
			$chatsCarregados[$j][0] = $username;
			$chatsCarregados[$j][1] = $res['msg'];
			$chatsCarregados[$j][2] = $userImg;
			$chatsCarregados[$j][3] = $res['msgDate'];
		}
		usort($chatsCarregados, array($this, 'date_sort'));
		return $chatsCarregados;
	}

	private function alterar_lido(){
		$this->conn->executeQuery('UPDATE assoc_chats SET vistos = 1 WHERE id = :ID', array(
			':ID' => $this->idChat;
		));
	}

	public function carregarMensagens($username){
		$idUser = $this->getId($username);
		$result = $this->conn->executeQuery('SELECT id FROM chats WHERE idUser = :IDUSER AND idUser2 = :IDUSER2', array(
			':IDUSER' => $this->userId,
			':IDUSER2' => $idUser
		));
		$result = $result->fetch();
		if(empty($result)){
			$result = $this->conn->executeQuery('SELECT id FROM chats WHERE idUser = :IDUSER AND idUser2 = :IDUSER2', array(
				':IDUSER' => $idUser,
				':IDUSER2' => $this->userId
			));
			$result = $result->fetch();
			if(empty($result)){
				return NULL;			
			}else{
				$this->idChat = $result['id'];
				$result = $this->conn->executeQuery('SELECT * FROM assoc_chats WHERE id = :ID ORDER BY msgDate ASC', array(
					':ID' => $this->idChat
				));
				$i = 0;
				while($row = $result->fetch()){
					$mensagem[$i] = $row;
					$i++;
				}
				for($j = 0; $j < $i; $j++){
					if($mensagem[$j]['idUser'] == $this->userId){
						$itsMe = TRUE;
					}else{
						$itsMe = FALSE;
					}
					$mensagens[$j][0] = $mensagem[$j]['msg'];
					$mensagens[$j][1] = $mensagem[$j]['msgDate'];
					$mensagens[$j][2] = $itsMe;
				}
				return $mensagens;
			}
		}else{
			$this->idChat = $result['id'];
			$result = $this->conn->executeQuery('SELECT * FROM assoc_chats WHERE id = :ID ORDER BY msgDate ASC', array(
				':ID' => $this->idChat
			));
			$i = 0;
			while($row = $result->fetch()){
				$mensagem[$i] = $row;
				$i++;
			}
			for($j = 0; $j < $i; $j++){
				if($mensagem[$j]['idUser'] == $this->userId){
					$itsMe = TRUE;
				}else{
					$itsMe = FALSE;
				}
				$mensagens[$j][0] = $mensagem[$j]['msg'];
				$mensagens[$j][1] = $mensagem[$j]['msgDate'];
				$mensagens[$j][2] = $itsMe;
			}
			return $mensagens;
		}
	}

	private function selectChat($id, $idUser, $isNew){
		$user = $this->getUserData($idUser);
		if($isNew == 0){
			$result = $this->conn->executeQuery('SELECT * FROM assoc_chats WHERE id = :ID ORDER BY msgDate ASC', array(
				':ID' => $id
			));
			$result = $result->fetch();
			$newChat[0] = $user['username'];
			$newChat[1] = $result['msg'];
			$newChat[2] = $user['imgUser'];
			$newChat[3] = $result['msgDate'];
			return $newChat;
		}else{
			$result = $this->conn->executeQuery('SELECT * FROM assoc_chats WHERE id = :ID ORDER BY msgDate ASC', array(
				':ID' => $id
			));
			$result = $result->fetch();
			$newChat[0] = $user['username'];
			$newChat[1] = "Envie uma nova mensagem";
			$newChat[2] = $user['imgUser'];
			$newChat[3] = (date("Y-m-d H:i:s"));
			return $newChat;
		}
	}

	public function enviarMensagem($mensagem){
		$this->conn->executeQuery('INSERT INTO assoc_chats VALUES (:ID, :MSG, :IDUSER, :MSGDATE, :VISTO)', array(
			':ID' => $this->idChat,
			':MSG' => $mensagem,
			':IDUSER' => $this->userId,
			':MSGDATE' => (date("Y-m-d H:i:s")),
			':VISTO' => 0
		));
	}

	public function novoChat($username){
		$result = $this->conn->executeQuery('SELECT id FROM users WHERE username = :USER', array(
			':USER' => $username
		));
		$result = $result->fetch();
		if(!empty($result)){
			$id = $result['id'];
			$res = $this->conn->executeQuery('SELECT id FROM chats WHERE idUser = :IDUSER AND idUser2 = :IDUSER2', array(
				':IDUSER' => $this->userId,
				':IDUSER2' => $id
			));
			$res = $res->fetch();
			if(!empty($res)){
				return $this->selectChat($res['id'], $id, 0);
			}else{
				$res = $this->conn->executeQuery('SELECT id FROM chats WHERE idUser = :IDUSER AND idUser2 = :IDUSER2', array(
					':IDUSER' => $id,
					':IDUSER2' => $this->userId
				));
				$res = $res->fetch();
				if(!empty($res)){
					return $this->selectChat($res['id'], $id, 0);
				}else{
					$this->conn->executeQuery('INSERT INTO chats (idUser, idUser2) VALUES (:ID, :ID2)', array(
						':ID' => $this->userId,
						':ID2' => $id
					));
					$res = $this->conn->executeQuery('SELECT id FROM chats WHERE idUser = :IDUSER AND idUser2 = :IDUSER2', array(
						':IDUSER' => $this->userId,
						':IDUSER2' => $id
					));
					$res = $res->fetch();
					return $this->selectChat($res['id'], $id, 1);
				}
			}
		}else{
			$_SESSION['usuarioNaoEncontrado'] = TRUE;
			return NULL;
		}
	}

}

// $chat = new chatModel();
// if($_POST['funcao'] == "novoChat"){
// 	$res = $chat->novoChat($_POST['username']);
// }else if($_POST['funcao'] == "carregarMensagens"){
// 	$res = $chat->carregarMensagens($_POST['username']);
// }


// echo json_encode((array(
//     'username' => "",
//     'funcao' => "",
//     'resposta' => $res
// )));