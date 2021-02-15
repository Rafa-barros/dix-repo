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
    public $liked;
    private $imgPost;
    private $descript;
    private $likes;
    private $qtdComentarios;
    private $postsVistos;
    private $usersVistos;
    private $idPost;
    private $idOp;
    private $idUser;
    private $postSel;

    public function __construct() {
        $this->conn = new Database();
    }

    public function getInfo($postsVistosJS, $usersVistosJS){
        if (!empty($postsVistosJS)){
            $this->postsVistos = $postsVistosJS;
            $this->usersVistos = $usersVistosJS;
        }
        $this->email = base64_decode($_COOKIE['cUser']);

        //Encontra o id do usuário
        $resultIdUser = $this->conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
            ':EMAIL' => $this->email
        ));
        $resultIdUser = $resultIdUser->fetch();
        $this->idUser = $resultIdUser['0'];

        //Encontra o id do dono do post
        $tam = count($this->usersVistos);
        $query = 'SELECT id FROM assoc_users WHERE idFollower = :ID';
        for ($i=0;$i<$tam;$i++){
            $query = $query . ' AND NOT id = ' . $this->usersVistos[$i];
        }
        $query = $query . ' ORDER BY RAND() LIMIT 1';
        $resultIdOp = $this->conn->executeQuery($query, array(
            ':ID' => $this->idUser
        ));
        if(!empty($resultIdOp)){
            $resultIdOp = $resultIdOp->fetch();
        }
        $this->idOp = $resultIdOp['0'];

        //Encontra o nome do dono do post
        $resultName = $this->conn->executeQuery('SELECT pname FROM users WHERE id = :ID', array(
            'ID' => $this->idOp
        ));
        $resultName = $resultName->fetch();
        $this->nameOp = $resultName['0'];

        //Encontra o nome do dono do post
        $resultUser = $this->conn->executeQuery('SELECT username FROM users WHERE id = :ID', array(
            'ID' => $this->idOp
        ));
        $resultUser = $resultUser->fetch();
        $this->userOp = $resultUser['0'];

        //Encontra a foto de perfil do dono do post
        $resultImgOp = $this->conn->executeQuery('SELECT imgUser FROM users WHERE id = :ID', array(
            ':ID' => $this->idOp
        ));
        $resultImgOp = $resultImgOp->fetch();
        $this->imgOp = $resultImgOp['0'];

    }
    
    public function selPost(){
        $tam = count($this->postsVistos);
        $query = 'SELECT * FROM posts WHERE idUser = :ID';
        for ($i=0;$i<$tam;$i++){
            $query = $query . ' AND NOT id = ' . intval($this->postsVistos[$i]);
        }
        $posts = $this->conn->executeQuery($query, array(
            ':ID' => intval($this->idOp)
        ));
        $likes = 0;
        if(!empty($posts)){
            while ($row = $posts->fetch(PDO::FETCH_ASSOC)){
                if ($row['likes'] >= $likes){
                    $likes = $row['likes'];
                    $this->postSel = $row;
                }
            }
        }

        if($this->postSel['userOp'] == null){
            $this->postSel['userV'] = $this->idOp;
        }else{
            $this->postSel['userV'] = null;
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
$postObj->getInfo($_POST['postsVistos'], $_POST['usersVistos']);
$postSel = $postObj->selPost();

echo json_encode((array(
    'nameOp' => utf8_encode($postObj->nameOp),
    'userOp' => $postObj->userOp,
    'data' => $postSel['postDate'],
    'imgOp' => $postObj->imgOp, 
    'imgPost' => $postSel['media'],
    "postsVistos" => "",
    "usersVistos" => "",
    "userReturn" => $postSel['userV'],
    "descricao" => utf8_encode($postSel['descript']),
    "likes" => $postSel['likes'],
    "liked" => $postObj->liked,
    "valor" => $postSel['price'],
    "gorjetas" => $postSel['amount'],
    "idPost" => $postSel['id'],
    "qtdComentarios" => $postSel['comments']
)));