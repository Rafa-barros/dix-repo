<?php

use PDO;

class Posts extends PDO {
    public function __construct(){
        $this->connection = new PDO("$this->db_sqlType:dbname=$this->db_name;host=$this->db_host;port=$this->db_port", "$this->db_user", "$this->db_pwd");
    }
}