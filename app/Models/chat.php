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
				$data = $this->getUserData($chats[$j]['idUser2'])
				$username = $data['username'];
				$userImg = $data['imgUser'];
			}else{
				$data = $this->getUserData($chats[$j]['idUser'])
				$username = $data['username'];
				$userImg = $data['imgUser'];
			}
			$chatsCarregados[$j][0] = $chats[$j]['id'];
			$chatsCarregados[$j][1] = $username;
			$chatsCarregados[$j][2] = $userImg;
			$chatsCarregados[$j][3] = $res['msg'];
			$chatsCarregados[$j][4] = $res['msgDate'];
		}
		usort($chatsCarregados, array($this, 'date_sort'));
		return $chatsCarregados;
	}

	public function carregarMensagens($id){
		$this->idChat;
		$result = $this->conn->executeQuery('SELECT * FROM assoc_chats WHERE id = :ID ORDER BY msgDate ASC', array(
			':ID' => $id
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

	public function enviarMensagem($mensagem){
		$this->conn->executeQuery('INSERT INTO assoc_chats VALUES (:ID, :MSG, :IDUSER, :MSGDATE)', array(
			':ID' => $this->idChat,
			':MSG' => $mensagem,
			':IDUSER' => $this->userId,
			':MSGDATE' => (date("Y-m-d H:i:s"))
		));
	}

}

?>