<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

class Post {
    public $conn;
    public $imgOp;
    public $nameOp;
    public $userOp;
    public $imgOpTemp;
    public $nameOpTemp;
    public $userOpTemp;
    public $liked;
    public $postsVistosJS;
    private $imgPost;
    private $descript;
    private $likes;
    private $qtdComentarios;
    private $postsVistos;
    private $idPost;
    private $idOp;
    private $idUser;
    private $postSel;
    private $tam;

    public function __construct() {
        $this->conn = new Database();
    }

    public function getInfo(){
        $this->email = base64_decode($_COOKIE['cUser']);

        //Encontra o id do usuário
        $resultIdUser = $this->conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
            ':EMAIL' => $this->email
        ));
        $resultIdUser = $resultIdUser->fetch();
        $this->idUser = $resultIdUser['0'];

        //Encontra o id do dono do post
        $resultIdOp = $this->conn->executeQuery('SELECT id FROM assoc_users WHERE idFollower = :ID', array(
            ':ID' => $this->idUser
        ));
        $i = 0;
        while($row = $resultIdOp->fetch()){
            $this->idOp[$i] = $row['id'];
            $i++;
        }
        $this->tam = $i;

        //Encontra o nome do dono do post
        for($j = 0; $j < $i; $j++){
            $resultName = $this->conn->executeQuery('SELECT pname FROM users WHERE id = :ID', array(
                'ID' => $this->idOp[$j]
            ));
            $resultName = $resultName->fetch();
            $this->nameOpTemp[$j] = $resultName['0'];
        }

        //Encontra o nome do dono do post
        for($j = 0; $j < $i; $j++){
            $resultUser = $this->conn->executeQuery('SELECT username FROM users WHERE id = :ID', array(
                'ID' => $this->idOp[$j]
            ));
            $resultUser = $resultUser->fetch();
            $this->userOpTemp[$j] = $resultUser['0'];
        }

        //Encontra a foto de perfil do dono do post
        for($j = 0; $j < $i; $j++){
            $resultImgOp = $this->conn->executeQuery('SELECT imgUser FROM users WHERE id = :ID', array(
                ':ID' => $this->idOp[$j]
            ));
            $resultImgOp = $resultImgOp->fetch();
            $this->imgOpTemp[$j] = $resultImgOp['0'];
        }

    }
    
    public function selPost(){
        $query = 'SELECT * FROM posts WHERE idUser IN (';
        foreach ($this->idOp as $key){
            $query = ($query . $key . ', ');
        }
        $query = substr($query, 0, -2);
        $query = $query . ') AND NOT id IN (';
        foreach($this->postsVistosJS as $idJaVisto){
            $query = ($query . $idJaVisto . ', ');
        }
        $query = substr($query, 0, -2);
        $query = $query . ') ORDER BY postDate DESC';
        $post = $this->conn->executeQuery($query);
        $post = $post->fetch();
        if(!empty($post)){
            $this->postSel = $post;
        }

        for($j = 0; $j < $this->tam; $j++){
            if($this->postSel['idUser'] == $this->idOp[$j]){
                $this->nameOp = $this->nameOpTemp[$j];
                $this->userOp = $this->userOpTemp[$j];
                $this->imgOp = $this->imgOpTemp[$j];
            }
        }


        //Retorna 0 ou 1 se o post foi curtido
        $resultLiked = $this->conn->executeQuery('SELECT * FROM assoc_users_likes WHERE idPost = :IDPOST AND idUser = :IDUSER', array(
            ':IDPOST' => $this->postSel['id'],
            ':IDUSER' => $this->idUser
        ));
        $resultLiked = $resultLiked->fetch();
        empty($resultLiked) ? $this->liked = 0 : $this->liked = 1;

        if ($this->postSel['allowView'] == 0){
            $resultUserBlocked = $this->conn->executeQuery('SELECT idPost FROM assoc_posts WHERE idUser = :ID AND idPost = :IDPOST', array(
                ':ID' => $this->idUser,
                ':IDPOST' => $this->postSel['id']
            ));
            $resultUserBlocked = $resultUserBlocked->fetch();
            if (isset($this->postSel['media'])){
                if (empty($resultUserBlocked)){
                    $this->postSel['descript'] = "<i>Esse post é pago, compre-o para ver a sua descrição e seu conteúdo</i>";
                    $extensaoCmps = explode(".", $this->postSel['media']);
                    $extensao = strtolower(end($extensaoCmps));
                    if ($extensao != 'mp4' && $extensao != 'avi' && $extensao != 'webp'){
                        $this->postSel['media'] = ("media/" . ((hash('haval128,5', $this->postSel['media'])) . "." . $extensao));
                    } else {
                        $this->postSel['media'] = "media/blockedVideo.png";
                    }
                }
            }
        }

        return $this->postSel;
    }
}

$postObj = new Post();
$postObj->postsVistosJS = $_POST['postsVistos'];
$postObj->getInfo();
$postSel = $postObj->selPost();

echo json_encode((array(
    'nameOp' => $postObj->nameOp,
    'userOp' => $postObj->userOp,
    'data' => $postSel['postDate'],
    'imgOp' => $postObj->imgOp, 
    'imgPost' => $postSel['media'],
    "postsVistos" => "",
    "descricao" => ($postSel['descript']),
    "likes" => $postSel['likes'],
    "liked" => $postObj->liked,
    "valor" => $postSel['price'],
    "gorjetas" => $postSel['amount'],
    "idPost" => $postSel['id'],
    "qtdComentarios" => $postSel['comments']
)));