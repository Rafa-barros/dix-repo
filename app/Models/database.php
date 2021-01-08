<?php

//Construindo um objeto de ligação com o banco de dados
class Database extends PDO{

	//Configurações do banco de dados
	private $db_sqlType = ''; //Tipo de SQL utilizado ex: mysql, pgsql
	private $db_name = ''; //Nome do banco de dados
	private $db_user = ''; //Usuário detentor do banco de dados
	private $db_pwd = ''; //Senha do usuário
	private $db_host = ''; //Hospedagem do banco de dados
	private $db_port = ''; //Porta da hospedagem

	//Armazena a conexão
	private $connection;

	//Quando um novo objeto é criado, essa função é executada se conectando ao banco de dados
	public function __construct(){
		$this->connection = new PDO("$this->db_sqlType:dbname=$this->db_name;host=$this->db_host;port=$this->db_port", "$this->db_user", "$this->db_pwd");
	}


?>