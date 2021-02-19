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

    private function callAPI(){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        $resultado = curl_exec($curl);
        $session = simplexml_load_string($resultado);
        
        return $session;
    }

    private function curlExec($url, $post = NULL, array $header = array()){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if(count($header) > 0) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);
     
        return simplexml_load_string($data);
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
        if(!empty($post)){
            $i = 0;
            while($row = $post->fetch()){
                $this->postSel[$i] = $row;
                if($i < 8){
                    $i++;
                }else{
                    break;
                }
            }
        }

        for($j = 0; $j < $this->tam; $j++){
            for($k = 0; $k < 8; $k++){
                if($this->postSel[$k]['idUser'] == $this->idOp[$j]){
                    $this->nameOp[$k] = $this->nameOpTemp[$j];
                    $this->userOp[$k] = $this->userOpTemp[$j];
                    $this->imgOp[$k] = $this->imgOpTemp[$j];
                }
            }
        }


        //Retorna 0 ou 1 se o post foi curtido
        for($j = 0; $j < 8; $j++){
            $resultLiked = $this->conn->executeQuery('SELECT * FROM assoc_users_likes WHERE idPost = :IDPOST AND idUser = :IDUSER', array(
                ':IDPOST' => $this->postSel[$j]['id'],
                ':IDUSER' => $this->idUser
            ));
            $resultLiked = $resultLiked->fetch();
            empty($resultLiked) ? $this->liked[$j] = 0 : $this->liked[$j] = 1;

            if ($this->postSel[$j]['allowView'] == 0){
                $resultUserBlocked = $this->conn->executeQuery('SELECT idPost FROM assoc_posts WHERE idUser = :ID AND idPost = :IDPOST', array(
                    ':ID' => $this->idUser,
                    ':IDPOST' => $this->postSel[$j]['id']
                ));
                $resultUserBlocked = $resultUserBlocked->fetch();
                if (isset($this->postSel[$j]['media'])){
                    if (empty($resultUserBlocked)){
                        $resultPagVip = $this->conn->executeQuery('SELECT transacao FROM assoc_users_vips WHERE id = :ID AND idFollower = :IDUSER', array(
                            ':ID' => $this->postSel[$j]['idUser'],
                            ':IDUSER' => $this->idUser
                        ));
                        $resultPagVip = $resultPagVip->fetch();
                        if (!empty($resultPagVip)){
                            $resultPS = $this->conn->executeQuery('SELECT email, token FROM uHe0b4W', array());
                            $resultPS = $resultPS->fetch();

                            $statusVip = $resultPagVip['0'];
                            $url = "https://ws.pagseguro.uol.com.br/v3/transactions/" . $statusVip . "?email=" . $resultPS['email'] . "&token=" . $resultPS['token'];
                            $retornoStatus = $this->curlExec($url);
                            
                            if ($retornoStatus->status != '3'){
                                $extensaoCmps = explode(".", $this->postSel[$j]['media']);
                                $extensao = strtolower(end($extensaoCmps));
                                if($extensao != '0'){
                                    if ($extensao != 'mp4' && $extensao != 'avi' && $extensao != 'webp'){
                                        $this->postSel[$j]['media'] = ("media/" . ((hash('haval128,5', $this->postSel[$j]['media'])) . "." . $extensao));
                                    } else {
                                        $this->postSel[$j]['media'] = "media/blockedVideo.png";
                                    }
                                }
                            }else{
                                $this->postSel[$j]['price'] = 0;
                            }
                        }else{
                            $extensaoCmps = explode(".", $this->postSel[$j]['media']);
                            $extensao = strtolower(end($extensaoCmps));
                            if($extensao != '0'){
                                if ($extensao != 'mp4' && $extensao != 'avi' && $extensao != 'webp'){
                                    $this->postSel[$j]['media'] = ("media/" . ((hash('haval128,5', $this->postSel[$j]['media'])) . "." . $extensao));
                                } else {
                                    $this->postSel[$j]['media'] = "media/blockedVideo.png";
                                }
                            } 
                        }
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

for($i = 0; $i < 8; $i++){
    $postDate[$i] = $postSel[$i]['postDate'];
    $media[$i] = $postSel[$i]['media'];
    $descript[$i] = $postSel[$i]['descript'];
    $likes[$i] = $postSel[$i]['likes'];
    $price[$i] = $postSel[$i]['price'];
    $amount[$i] = $postSel[$i]['amount'];
    $id[$i] = $postSel[$i]['id'];
    $comments[$i] = $postSel[$i]['comments'];
}

echo json_encode((array(
    'nameOp' => $postObj->nameOp,
    'userOp' => $postObj->userOp,
    'data' => $postDate,
    'imgOp' => $postObj->imgOp, 
    'imgPost' => $media,
    "postsVistos" => "",
    "descricao" => $descript,
    "likes" => $likes,
    "liked" => $postObj->liked,
    "valor" => $price,
    "gorjetas" => $amount,
    "idPost" => $id,
    "qtdComentarios" => $comments
)));