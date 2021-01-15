<?php

require ('././database.php');

class Post {
    public $email;
    public $idOp;
    public $imgOp;
    public $imgPost;
    public $descript;
    public $likes;
    public $qtdComentarios;
    public $postsVistos;

    public function __construct() {
        $conn = new Database();
    }

    public function getInfo($email){
        $this->email = htmlentities($email);
        //Procurar o nome do dono do post e a data do post
    }

    private function sortOp(){
        //Procurar o dono do post de acordo com a pessoa que o usuário segue
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

    private function selPost(){
        $posts = listarPostsDisponiveis();
        $likes = 0;
        while ($row = $posts->fetch(PDO::FETCH_ASSOC)){
            if ($row['likes'] >= $likes){
                $likes = $row['likes'];
                $postSel = $row;
            }
        }

        return $postSel; //$postSel['id'], $postSel['media']
    }
}

$postObj = new Post();
$postObj->getInfo($_POST['email']);
$postSel = $postObj->selPost();

echo json_encode((array(
    'email' => $postSel['email'], 
    'imgOp' => $postSel[''], 
    'imgPost' => "a",
    'idPost' => "a",
    "postsVistos" => $postsVistos,
    "descricao" => "a",
    "likes" => "a",
    "codigo" => 0,
    "qtdComentarios" => 2
)));