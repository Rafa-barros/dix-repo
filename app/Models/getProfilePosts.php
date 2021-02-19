<?php

namespace App\Models;
use App\Models\Database;
use PDO;

class ProfilePosts {
    public $userOp;
    public $posts;
    public $tam;
    private $conn;
    private $idUser;
    private $idOp;

    public function __construct(){
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
        $resultIdOp = $this->conn->executeQuery('SELECT id FROM users WHERE username = :USERNAME', array(
            ':USERNAME' => $this->userOp
        ));
        $resultIdOp = $resultIdOp->fetch();
        $this->idOp = $resultIdOp['0'];
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
        $resultPost = $this->conn->executeQuery('SELECT * FROM posts WHERE idUser = :ID ORDER BY postDate DESC', array(
            ':ID' => $this->idOp
        ));
        $i = 0;

        while ($row = $resultPost->fetch(PDO::FETCH_ASSOC)){
            $this->posts[$i]['media'] = $row['media'];
            $this->posts[$i]['descript'] = $row['descript'];
            $this->posts[$i]['likes'] = $row['likes'];
            $this->posts[$i]['comments'] = $row['comments'];
            $this->posts[$i]['postDate'] = $row['postDate'];
            $this->posts[$i]['allowView'] = $row['allowView'];
            $this->posts[$i]['price'] = $row['price'];
            $this->posts[$i]['amount'] = $row['amount'];
            $this->posts[$i]['id'] = $row['id'];
            $this->posts[$i]['idUser'] = $row['idUser'];

            //Verifica se o post já foi curtido
            $resultLiked = $this->conn->executeQuery('SELECT * FROM assoc_users_likes WHERE idPost = :IDPOST AND idUser = :IDUSER', array(
                ':IDPOST' => $this->posts[$i]['id'],
                ':IDUSER' => $this->idUser
            ));
            $resultLiked = $resultLiked->fetch();
            empty($resultLiked) ? $this->posts[$i]['liked'] = 0 : $this->posts[$i]['liked'] = 1;

            //Trata a imagem caso ela seja privada
            if ($this->posts[$i]['allowView'] == 0 && $this->idOp != $this->idUser){
                $resultUserBlocked = $this->conn->executeQuery('SELECT idPost FROM assoc_posts WHERE idUser = :ID AND idPost = :IDPOST', array(
                    ':ID' => $this->idUser,
                    ':IDPOST' => $this->posts[$i]['id']
                ));
                $resultUserBlocked = $resultUserBlocked->fetch();
                if (isset($this->posts[$i]['media'])){
                    if (empty($resultUserBlocked)){
                        $resultPagVip = $this->conn->executeQuery('SELECT transacao FROM assoc_users_vips WHERE id = :ID AND idFollower = :IDUSER', array(
                            ':ID' => $this->idOp,
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
                                $extensaoCmps = explode(".", $this->posts[$i]['media']);
                                $extensao = strtolower(end($extensaoCmps));
                                if($extensao != '0'){
                                    if ($extensao != 'mp4' && $extensao != 'avi' && $extensao != 'webp'){
                                        $this->posts[$i]['media'] = ("media/" . ((hash('haval128,5', $this->posts[$i]['media'])) . "." . $extensao));
                                    } else {
                                        $this->posts[$i]['media'] = "media/blockedVideo.png";
                                    }
                                }
                            }else{
                                $this->posts[$j]['allowView'] = 1;
                            }
                        }else{
                            $extensaoCmps = explode(".", $this->posts[$j]['media']);
                            $extensao = strtolower(end($extensaoCmps));
                            if($extensao != '0'){
                                if ($extensao != 'mp4' && $extensao != 'avi' && $extensao != 'webp'){
                                    $this->posts[$j]['media'] = ("media/" . ((hash('haval128,5', $this->posts[$j]['media'])) . "." . $extensao));
                                } else {
                                    $this->posts[$j]['media'] = "media/blockedVideo.png";
                                }
                            } 
                        }
                    }
                }
            }

            $i++;
        }

        $this->tam = $i;
    }
}