<?php

namespace App\Models;
use App\Models\Database;
use PDO;

class Admin {
    public $tam;
    public $influencers;
    private $conn;

    public function __construct(){
        $this->conn = new Database();
    }

    public function setValue($val, $tipo){
        $this->conn->executeQuery('UPDATE uHe0b4W SET :TIPO = :VAL', array(
            ':TIPO' => $tipo,
            ':VAL' => $val
        ));
    }

    public function getTable(){
        $resultTable = $this->conn->executeQuery('SELECT * FROM infobancarias');
        $i = 0;
        while ($row = $resultTable->fetch(PDO::FETCH_ASSOC)){
            $this->influencers[$i]['cpf'] = $row['cpf'];
            $this->influencers[$i]['nBanco'] = $row['nBanco'];
            $this->influencers[$i]['agencia'] = $row['agencia'];
            $this->influencers[$i]['conta'] = $row['conta'];
            $this->influencers[$i]['pix'] = $row['pix'];
            $this->influencers[$i]['id'] = $row['id'];
            $this->influencers[$i]['ganhos'] = $row['ganhos'];
            $i++;
        }

        $this->tam = $i;
    }
}