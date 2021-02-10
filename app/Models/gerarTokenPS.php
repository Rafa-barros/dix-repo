<?php

namespace App\Models;
use App\Models\Database;

class Token {
    private $conn;
    public $key;
    public $id;

    public function __construct(){
        $this->conn = new Database();
        $resultId = $this->conn->executeQuery('SELECT id FROM uHe0b4W', array());
        $resultId = $resultId->fetch();
        $this->id = $resultId['0'];

        $resultKey = $this->conn->executeQuery('SELECT chave FROM uHe0b4W', array());
        $resultKey = $resultKey->fetch();
        $this->key = $resultKey['0'];
    }

    public function callAPI($url, $params){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/vnd.pagseguro.com.br.v3+xml', 'Content-Type: application/x-www-form-urlencoded'));
        $resultado = curl_exec($curl);
        //echo $resultado;
        $session = simplexml_load_string($resultado)->id;
        
        return $session;
    }
    
}

$token = new Token();

?>