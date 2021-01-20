<?php

require ('uploadMedia.php');

class newPost {
    private $conn;
    private $email;
    private $idUser;

    public function __construct(){
        $this->conn = new Database();
    }

    public function getInfo($email){
        $this->email = htmlentities($email);
        $resultIdUser = $this->conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
            ':EMAIL' => $email
        ));
        $resultIdUser = $resultIdUser->fetch();
        $this->idUser = $resultIdUser['0'];
    }

    public function uploadPost($media, $descript, $allowView, $price){
        $this->conn->executeQuery('INSERT INTO posts (idUser, media, descript, likes, comments, postDate, allowView, price, amount) VALUES (:IDUSER, :MEDIA, :DESCRIPT, :LIKES, :COMMENTS, :POSTDATE, :ALLOWVIEW, :PRICE, :AMOUNT)', array(
            ':IDUSER' => $this->idUser,
            ':MEDIA' => $media,
            ':DESCRIPT' => $descript,
            ':LIKES' => 0,
            ':COMMENTS' => 0,
            ':POSTDATE' => (date("Y-m-d H:i:s")),
            ':ALLOWVIEW' => $allowView,
            ':PRICE' => $price,
            ':AMOUNT' => 0
        ));
    }
}

$upMedia = new newMedia();
$media = $upMedia->uploadPostMedia();

$novoPost = new newPost();
$newPost->getInfo($_COOKIE['cUser']);
$newPost->uploadPost($media, (htmlentities($_POST['descricao'])), (htmlentities($_POST['postLiberado'])), (htmlentities($_POST['valor'])));