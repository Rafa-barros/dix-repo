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
    private $postSel;

    public function __construct() {
        $this->conn = new Database();
    }

    public function getInfo($email, $postsVistosJS){
        if (!empty($postsVistosJS)){
            $this->postsVistos = $postsVistosJS;
        }
        $this->email = htmlentities($email);

        //Encontra o id do usuário
        $resultIdUser = $this->conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
            ':EMAIL' => $email
        ));
        $resultIdUser = $resultIdUser->fetch();
        $this->idUser = $resultIdUser['0'];

        //Encontra o id do dono do post
        $resultIdOp = $this->conn->executeQuery('SELECT id FROM assoc_users WHERE idFollower = :ID ORDER BY RAND() LIMIT 1', array(
            ':ID' => $this->idUser
        ));
        $resultIdOp = $resultIdOp->fetch();
        $this->idOp = $resultIdOp['0'];

        //Encontra o nome do dono do post
        $resultName = $this->conn->executeQuery('SELECT pname FROM users WHERE id = :ID', array(
            'ID' => $this->idOp
        ));
        $resultName = $resultName->fetch();
        $this->nameOp = $resultName['0'];

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

error_reporting(0);

$postObj = new Post();
$postObj->getInfo($_POST['email'], $_POST['postsVistos']);
$postSel = $postObj->selPost();

echo json_encode((array(
    'email' => "", 
    'nameOp' => $postObj->nameOp,
    'data' => $postSel['postDate'],
    'imgOp' => $postObj->imgOp, 
    'imgPost' => $postSel['media'],
    "postsVistos" => "",
    "descricao" => $postSel['descript'],
    "likes" => $postSel['likes'],
    "valor" => $postSel['price'],
    "gorjetas" => $postSel['amount'],
    "idPost" => $postSel['id'],
    "qtdComentarios" => $postSel['comments']
)));