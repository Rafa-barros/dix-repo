<?php

require ('././database.php');

class Post {
    public $imgOp;
    private $email;
    private $nameOp;
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

    public function __construct() {
        $conn = new Database();
    }

    private function getImg(){
        $resultImgOp = $conn->executeQuery('SELECT imgUser FROM users WHERE id = :ID', array(
            ':ID' => $idOp
        ));
        $resultImgOp->fetch();
        $imgOp = $resultImgOp[0];

        $resultImgPost = $conn->executeQuery('SELECT img FROM posts WHERE id = :ID', array(
            ':ID' => $idPost
        ));
        $resultImgPost->fetch();
        $imgOp = $resultImgPost[0];
    }

    public function getInfo($email, $postsVistosJS){
        $this->postsVistos = $postsVistosJS;
        $this->email = htmlentities($email);

        //Encontra o id do usuário
        $resultIdUser = $conn->executeQuery('SELECT id FROM users WHERE email = :EMAIL', array(
            ':EMAIL' => $email
        ));
        $resultIdUser->fetch();
        $idUser = $resultIdUser[0];

        //Encontra o id do dono do post
        $resultIdOp = $conn->executeQuery('SELECT id FROM assoc_users WHERE idFollower = :ID ORDER BY RAND() LIMIT 1', array(
            ':ID' => $idUser
        ));
        $resultIdOp->fetch();
        $idOp = $resultIdOp[0];

        //Encontra o nome do dono do post
        $resultName = $conn->executeQuery('SELECT pname FROM users WHERE idUser = :ID', array(
            'ID' => $idOp
        ));
        $resultName->fetch();
        $nameOp = $resultName[0];
    }

    private function listarPostsDisponiveis(){
        $tam = count($this->postsVistos);
        $query = 'SELECT * FROM posts WHERE idUser = :ID';
        for ($i=0;$i<$tam;$i++){
            $query = $query . ' AND NOT id = ' . $postsVistos[$i];
        }
        
        return $conn->executeQuery($query, array(
            ':ID' => $this->idOp
        ));
    }

    public function selPost(){
        $posts = listarPostsDisponiveis();
        $likes = 0;
        while ($row = $posts->fetch(PDO::FETCH_ASSOC)){
            if ($row['likes'] >= $likes){
                $likes = $row['likes'];
                $postSel = $row;
            }
        }
        getImg();

        if ($postSel['allowView'] == 0){
            $resultUserBlocked = $conn->executeQuery('SELECT idPost FROM assoc_posts WHERE idUser = :ID LIMIT 1', array(
                ':ID' => $idUser
            ));
            $resultUserBlocked->fetch();
            if (empty($resultUserBlocked)){
                $postSel['media'] = "BLOCKED";
            }
        }

        return $postSel;
    }
}

$postObj = new Post();
$postObj->getInfo($_POST['email'], $_POST['postsVistos']);
$postSel = $postObj->selPost();

echo json_encode((array(
    'email' => $postSel['email'], 
    'imgOp' => $postObj->imgOp, 
    'imgPost' => $postSel['img'],
    "postsVistos" => $postsVistos,
    "descricao" => $postSel['descript'],
    "likes" => $postSel['likes'],
    "qtdComentarios" => $postSel['comments']
)));