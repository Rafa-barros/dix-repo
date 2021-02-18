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

	public static function date_sort($a, $b){
		return strtotime($a[3]) - strtotime($b[3]);
	}

	public function carregarChats(){
		$this->userId = intval($this->userId);
		$result = $this->conn->executeQuery('SELECT * FROM chats WHERE idUser = :ID OR idUser2 = :ID', array(
			':ID' => $this->userId
		));
		$i = 0;
		while($row = $result->fetch()){
			$chats[$i] = $row;
			$i++;
		}
		for($j = 0; $j < $i; $j++){
			$res = $this->conn->executeQuery('SELECT * FROM assoc_chats WHERE id = :ID ORDER BY msgDate DESC', array(
				':ID' => $chats[$j]['id']
			));
			$res = $res->fetch();
			if($res['idUser'] == $this->userId){
				$itsMe = 1;
			}else{
				$itsMe = 0;
			}
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
			$chatsCarregados[$j][4] = $res['visto'];
			$chatsCarregados[$j][5] = $itsMe;
		}
		if($i != 0){
			usort($chatsCarregados, array($this, 'date_sort'));
		}
		return $chatsCarregados;
	}

	private function alterar_lido($id){
		$this->conn->executeQuery('UPDATE assoc_chats SET visto = 1 WHERE id = :ID AND idUser = :IDUSER', array(
			':ID' => $this->idChat,
			':IDUSER' => $id
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
				$this->alterar_lido($idUser);
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
						$itsMe = 1;
					}else{
						$itsMe = 0;
					}
					$mensagens[$j][0] = $mensagem[$j]['msg'];
					$mensagens[$j][1] = $itsMe;
					$mensagens[$j][2] = $mensagem[$j]['msgDate'];
					$mensagens[$j][3] = 0;
				}
				return $mensagens;
			}
		}else{
			$this->idChat = $result['id'];
			$this->alterar_lido($idUser);
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
					$itsMe = 1;
				}else{
					$itsMe = 0;
				}
				$mensagens[$j][0] = $mensagem[$j]['msg'];
				$mensagens[$j][1] = $itsMe;
				$mensagens[$j][2] = $mensagem[$j]['msgDate'];
				$mensagens[$j][3] = 0;
			}
			return $mensagens;
		}
	}

	private function selectChat($id, $idUser, $isNew){
		$user = $this->getUserData($idUser);
		if($id == NULL && $isNew == 1){
			$newChat[0] = $user['username'];
			$newChat[1] = "Envie uma nova mensagem";
			$newChat[2] = $user['imgUser'];
			$newChat[3] = (date("Y-m-d H:i:s"));
			return $newChat;
		}else{
			$result = $this->conn->executeQuery('SELECT * FROM assoc_chats WHERE id = :ID ORDER BY msgDate DESC', array(
				':ID' => $id
			));
			$result = $result->fetch();
			$newChat[0] = $user['username'];
			$newChat[1] = $result['msg'];
			$newChat[2] = $user['imgUser'];
			$newChat[3] = $result['msgDate'];
			return $newChat;
		}
	}

	public function enviarMensagem($username, $mensagem){
		$idUser2 = $this->getId($username);
		$result = $this->conn->executeQuery('SELECT * FROM chats WHERE idUser = :ID AND idUser2 = :ID2', array(
			':ID' => $this->userId,
			':ID2' => $idUser2
		));
		$result = $result->fetch();
		if(empty($result)){
			$res = $this->conn->executeQuery('SELECT * FROM chats WHERE idUser = :ID AND idUser2 = :ID2', array(
				':ID' => $idUser2,
				':ID2' => $this->userId
			));
			$res = $res->fetch();
			if(empty($res)){
				$id = $this->getId($username);
				$this->conn->executeQuery('INSERT INTO chats (idUser, idUser2) VALUES (:ID, :ID2)', array(
					':ID' => $this->userId,
					':ID2' => $id
				));
				$result = $this->conn->executeQuery('SELECT * FROM chats WHERE idUser = :ID AND idUser2 = :ID2', array(
					':ID' => $this->userId,
					':ID2' => $id
				));
				$result = $result->fetch();
				$idChat = $result['id'];
				$this->conn->executeQuery('INSERT INTO assoc_chats VALUES (:ID, :MSG, :IDUSER, :MSGDATE, :VISTO)', array(
					':ID' => $idChat,
					':MSG' => $mensagem,
					':IDUSER' => $this->userId,
					':MSGDATE' => (date("Y-m-d H:i:s")),
					':VISTO' => 0
				));
			}else{
				$idChat = $res['id'];
				$this->conn->executeQuery('INSERT INTO assoc_chats VALUES (:ID, :MSG, :IDUSER, :MSGDATE, :VISTO)', array(
					':ID' => $idChat,
					':MSG' => $mensagem,
					':IDUSER' => $this->userId,
					':MSGDATE' => (date("Y-m-d H:i:s")),
					':VISTO' => 0
				));
			}
		}else{
			$idChat = $result['id'];
			$this->conn->executeQuery('INSERT INTO assoc_chats VALUES (:ID, :MSG, :IDUSER, :MSGDATE, :VISTO)', array(
				':ID' => $idChat,
				':MSG' => $mensagem,
				':IDUSER' => $this->userId,
				':MSGDATE' => (date("Y-m-d H:i:s")),
				':VISTO' => 0
			));
		}
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
					return $this->selectChat(NULL, $id, 1);
				}
			}
		}else{
			$_SESSION['usuarioNaoEncontrado'] = TRUE;
			return NULL;
		}
	}

	public function verificarNewMsg($mensagem, $username, $msgDate){
		$idUser = $this->getId($username);
		$result = $this->conn->executeQuery('SELECT id FROM chats WHERE idUser = :IDUSER AND idUser2 = :IDUSER2', array(
			':IDUSER' => $this->userId,
			':IDUSER2' => $idUser
		));
		$result = $result->fetch();
		if(!empty($result)){
			$idChat = $result['id'];
			$lastMsg = $this->conn->executeQuery('SELECT * FROM assoc_chats WHERE id = :ID AND idUser = :IDUSER ORDER BY msgDate DESC', array(
				':ID' => $idChat,
				':IDUSER' => $idUser
			));
			$lastMsg = $lastMsg->fetch();
			if($lastMsg['msg'] == $mensagem && $lastMsg['msgDate'] == $msgDate){
				return NULL;
			}else{
				$newMsg[0] = $lastMsg['msg'];
				$newMsg[1] = $lastMsg['msgDate'];
				$this->idChat = $idChat;
				$this->alterar_lido($idUser);
				return $newMsg;
			}
		}else{
			$result = $this->conn->executeQuery('SELECT id FROM chats WHERE idUser = :IDUSER AND idUser2 = :IDUSER2', array(
				':IDUSER' => $idUser,
				':IDUSER2' => $this->userId
			));
			$result = $result->fetch();
			$idChat = $result['id'];
			$lastMsg = $this->conn->executeQuery('SELECT * FROM assoc_chats WHERE id = :ID AND idUser = :IDUSER ORDER BY msgDate DESC', array(
				':ID' => $idChat,
				':IDUSER' => $idUser
			));
			$lastMsg = $lastMsg->fetch();
			if($lastMsg['msg'] == $mensagem && $lastMsg['msgDate'] == $msgDate){
				return NULL;
			}else{
				$newMsg[0] = $lastMsg['msg'];
				$newMsg[1] = $lastMsg['msgDate'];
				$this->idChat = $idChat;
				$this->alterar_lido($idUser);
				return $newMsg;
			}
		}
	}

	public function attContatos($chatsLidos){
		$result = $this->conn->executeQuery('SELECT * FROM chats WHERE idUser = :ID OR idUser2 = :ID', array(
			':ID' => $this->userId
		));
		$i = 0;
		while($row = $result->fetch()){
			$chats[$i] = $row;
			$i++;
		}
		$diff = 0;
		$tam = count($chatsLidos);
		for($j = 0; $j <= $tam; $j++){
			$id = $this->getId($chatsLidos[$j][0]);
			$result = $this->conn->executeQuery('SELECT * FROM chats WHERE idUser = :ID AND idUser2 = :ID2', array(
				':ID' => $this->userId,
				':ID2' => $id
			));
			$result = $result->fetch();
			if(!empty($result)){
				$cl[$j]['id'] = $result['id'];
				$cl[$j]['msg'] = htmlentities($chatsLidos[$j][1]);
				$cl[$j]['msg'] = html_entity_decode($cl[$j]['msg']);
				$cl[$j]['msgDate'] = str_replace('/', ' ', $chatsLidos[$j][2]);
			}else{
				$result = $this->conn->executeQuery('SELECT * FROM chats WHERE idUser = :ID AND idUser2 = :ID2', array(
					':ID' => $id,
					':ID2' => $this->userId
				));
				$result = $result->fetch();
				$cl[$j]['id'] = $result['id'];
				$cl[$j]['msg'] = htmlentities($chatsLidos[$j][1]);
				$cl[$j]['msg'] = html_entity_decode($cl[$j]['msg']);
				$cl[$j]['msgDate'] = str_replace('/', ' ', $chatsLidos[$j][2]);
			}
		}
		if($tam < $i){
			$diff = $i - $tam;
		}
		$n = 0;
		for($j = 0; $j < $i; $j++){
			$res = $this->conn->executeQuery('SELECT * FROM assoc_chats WHERE id = :ID ORDER BY msgDate DESC', array(
				':ID' => $chats[$j]['id']
			));
			$res = $res->fetch();
			$cn['id'] = $res['id'];
			$cn['msg'] = htmlentities($res['msg']);
	        if(strlen($cn['msg']) > 16){
	            $cn['msg'] = substr($cn['msg'], 0, 15);
	            $cn['msg'] = $cn['msg'] . '...';
	        }
	        $cn['msg'] = html_entity_decode($cn['msg']);
			$cn['msgDate'] = $res['msgDate'];
			for($k = 0; $k <= $tam; $k++){
				if($cl[$k]['id'] == $cn['id']){
					$result = array_diff($cn, $cl[$k]);
					if(!empty($result)){
						if($res['idUser'] == $this->userId){
							$itsMe = 1;
						}else{
							$itsMe = 0;
						}
						if($chats[$j]['idUser'] == $this->userId){
							$data = $this->getUserData($chats[$j]['idUser2']);
							$username = $data['username'];
							$userImg = $data['imgUser'];
						}else{
							$data = $this->getUserData($chats[$j]['idUser']);
							$username = $data['username'];
							$userImg = $data['imgUser'];
						}
						$newMsg[$n][0] = $username;
						$newMsg[$n][1] = htmlentities($res['msg']);
						$newMsg[$n][2] = $userImg;
						$newMsg[$n][3] = $res['msgDate'];
						$newMsg[$n][4] = $res['visto'];
						$newMsg[$n][5] = $itsMe;
						$n++;
					}
				}else if($k == $tam && $diff != 0){
					if($res['idUser'] == $this->userId){
						$itsMe = 1;
					}else{
						$itsMe = 0;
					}
					if($chats[$j]['idUser'] == $this->userId){
						$data = $this->getUserData($chats[$j]['idUser2']);
						$username = $data['username'];
						$userImg = $data['imgUser'];
					}else{
						$data = $this->getUserData($chats[$j]['idUser']);
						$username = $data['username'];
						$userImg = $data['imgUser'];
					}
					$newMsg[$n][0] = $username;
					$newMsg[$n][1] = htmlentities($res['msg']);
					$newMsg[$n][2] = $userImg;
					$newMsg[$n][3] = $res['msgDate'];
					$newMsg[$n][4] = $res['visto'];
					$newMsg[$n][5] = $itsMe;
					$n++;
				}
			}
		}
		if($n != 0){
			usort($newMsg, array($this, 'date_sort'));
		}
		
		return $newMsg;
	}

}
