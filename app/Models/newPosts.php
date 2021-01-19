<?php

namespace App\Models;

use App\Models\Database;
use PDO;

require "../../vendor/autoload.php";

class Post {
    public $conn;
    public $imgOp;
    public $nameOp;
    private $email;
    private $imgPost;
    private $descript;
    private $likes;
    private $qtdComentarios;
    private $postsVistos;
    private $idPost;
    private $idOp;
    private $idUser;
    private $resultIdUser;
    private $resultIdOp;
    private $resultName;
    private $resultImgOp;
    private $resultImgPost;
    private $resultUserBlocked;
    private $postSel;

    public function __construct() {
        $this->conn = new Database();
    }

    /*private function getImg(){
        $resultImgOp = $this->conn->executeQuery('SELECT imgUser FROM users WHERE id = :ID', array(
            ':ID' => $this->idOp
        ));
        $resultImgOp->fetch();
        $imgOp = $resultImgOp[0];

        $resultImgPost = $this->conn->executeQuery('SELECT img FROM posts WHERE id = :ID', array(
            ':ID' => $idPost
        ));
        $resultImgPost->fetch();
        $imgOp = $resultImgPost[0];
    }*/

    public function getInfo($email, $postsVistosJS){
        $this->postsVistos = $postsVistosJS;
        $this->email = htmlentities($email);

        //Encontra o id do usuário
        $resultIdUser = $this->conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
            ':EMAIL' => $email
        ));
        $resultIdUser = $resultIdUser->fetch();
        foreach($resultIdUser as $key => $value){
            if($key == "0"){
                $this->idUser = $value;
            }
        }

        //Encontra o id do dono do post
        $resultIdOp = $this->conn->executeQuery('SELECT id FROM assoc_users WHERE idFollower = :ID ORDER BY RAND() LIMIT 1', array(
            ':ID' => $this->idUser
        ));
        $resultIdOp = $resultIdOp->fetch();
        foreach($resultIdOp as $key => $value){
            if($key == "0"){
                $this->idOp = $value;
            }
        }

        //Encontra o nome do dono do post
        $resultName = $this->conn->executeQuery('SELECT pname FROM users WHERE id = :ID', array(
            'ID' => $this->idOp
        ));
        $resultName = $resultName->fetch();
        foreach($resultName as $key => $value){
            if($key == "0"){
                $this->nameOp = $value;
            }
        }
    }

    /*private function listarPostsDisponiveis(){
        
        
        return $posts;
    }*/

    public function selPost(){
        $tam = count($this->postsVistos);
        $query = 'SELECT * FROM posts WHERE idUser = :ID';
        for ($i=0;$i<$tam;$i++){
            $query = $query . ' AND NOT id = ' . $this->postsVistos[$i];
        }

        $posts = $this->conn->executeQuery($query, array(
            ':ID' => $this->idOp
        ));
        $likes = 0;
        while ($row = $posts->fetch(PDO::FETCH_ASSOC)){
            if ($row['likes'] >= $likes){
                $likes = $row['likes'];
                $this->postSel = $row;
            }
        }
        $resultImgOp = $this->conn->executeQuery('SELECT imgUser FROM users WHERE id = :ID', array(
            ':ID' => $this->idOp
        ));
        $resultImgOp = $resultImgOp->fetch();
        foreach($resultImgOp as $key => $value){
            if($key == "0"){
                $this->imgOp = $value;
            }
        }

        $resultImgPost = $this->conn->executeQuery('SELECT img FROM posts WHERE id = :ID', array(
            ':ID' => $this->idPost
        ));
        /*$resultImgPost = $resultImgPost->fetch();
        foreach($resultImgPost as $key => $value){
            if($key == "0"){
                $this->imgPost = $value;
            }
        }*/

        if ($this->postSel['allowView'] == 0){
            $resultUserBlocked = $this->conn->executeQuery('SELECT idPost FROM assoc_posts WHERE idUser = :ID LIMIT 1', array(
                ':ID' => $this->idUser
            ));
            $resultUserBlocked = $resultUserBlocked->fetch();
            if (empty($resultUserBlocked)){
                $this->postSel['media'] = "BLOCKED";
            }
        }

        return $this->postSel;
    }
}

$postObj = new Post();
$postObj->getInfo($_POST['email'], $_POST['postsVistos']);
$postSel = $postObj->selPost();

echo json_encode((array(
    'email' => "", 
    'nameOp' => $postObj->nameOp,
    'imgOp' => $postObj->imgOp, 
    'imgPost' => $postSel['img'],
    "postsVistos" => "",
    "description" => $postSel['descript'],
    "likes" => $postSel['likes'],
    "qtdComentarios" => $postSel['comments']
)));