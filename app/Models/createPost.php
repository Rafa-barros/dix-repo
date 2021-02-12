<?php

namespace App\Models;

use App\Models\Database;
use App\Models\uploadMedia;

class createPost {
    private $conn;
    private $email;
    private $idUser;
    private $nPosts;

    public function __construct(){
        $this->conn = new Database();
    }

    public function getInfo($email){
        $this->email = htmlentities($email);
        $result = $this->conn->executeQuery('SELECT id, posts FROM users WHERE email = :EMAIL', array(
            ':EMAIL' => $email
        ));
        $result = $result->fetch();
        $this->idUser = $result['0'];
        $this->nPosts = $result['1'];
    }

    public function uploadPost($media, $descript, $allowView, $price){
        $this->nPosts = intval($this->nPosts) + 1;
        $this->conn->executeQuery('INSERT INTO posts (idUser, media, descript, likes, comments, postDate, allowView, price, amount) VALUES (:IDUSER, :MEDIA, :DESCRIPT, :LIKES, :COMMENTS, :POSTDATE, :ALLOWVIEW, :PRICE, :AMOUNT)', array(
            ':IDUSER' => $this->idUser,
            ':MEDIA' => $media,
            ':DESCRIPT' => $descript,
            ':LIKES' => 0,
            ':COMMENTS' => 0,
            ':POSTDATE' => (date("Y-m-d H:i:s")),
            ':ALLOWVIEW' => $allowView,
            ':PRICE' => intval($price),
            ':AMOUNT' => 0
        ));
        $this->conn->executeQuery('UPDATE users SET posts = :POSTS WHERE id = :ID', array(
            ':POSTS' => $this->nPosts,
            ':ID' => $this->idUser
        ));
    }
}

$upMedia = new uploadMedia();
$media = $upMedia->uploadPostMedia();
$extensaoCmps = explode(".", $media);
$extensao = strtolower(end($extensaoCmps));

$imagemBorrada = new Imagick($media);
$imagemBorrada->blurImage(40,40);
$imagemBorrada->writeImage('/media' . (hash('haval128,5', $media)) . $extensao);

$novoPost = new createPost();
$novoPost->getInfo('viniciusventurini@estudante.ufscar.br');
$novoPost->uploadPost($media, (htmlentities($_POST['descriptPost'])), (htmlentities($_POST['postLiberado'])), (htmlentities($_POST['valor'])));