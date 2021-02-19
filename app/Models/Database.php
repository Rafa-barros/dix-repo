<?php

namespace App\Models;
use PDO;

//Construindo um objeto de ligação com o banco de dados
class Database extends PDO{

	//Configurações do banco de dados
	private $db_sqlType = 'mysql'; //Tipo de SQL utilizado ex: mysql, pgsql
	private $db_name = 'dix'; //Nome do banco de dados
	private $db_user = 'root'; //Usuário detentor do banco de dados
	private $db_pwd = 'Dix@adm78'; //Senha do usuário
	private $db_host = 'localhost'; //Hospedagem do banco de dados
	private $db_port = '3306'; //Porta da hospedagem

	//Armazena a conexão
	private $connection;

	//Quando um novo objeto é criado, essa função é executada se conectando ao banco de dados
	public function __construct(){
		$this->connection = new PDO("$this->db_sqlType:dbname=$this->db_name;host=$this->db_host;port=$this->db_port", "$this->db_user", "$this->db_pwd");
	}

	/*Essa função recebe os valores enviados pela função mountQuery() e atrubui os valores às variáveis.
	*/
	private function setParameters($stmt, $key, $value){
		$stmt->bindParam($key, $value);
	}

	/*Essa função vai receber a query já preparada, e vai percorrer o array dos parâmetros, enviando-os para a função setParameters() setar cada variável da requisição sql para o valor a ser utilizada.
	$stmt é a query já pronta
	$key é a variável da requisição sql
	$value é o valor a ser utilizado na variável
	*/
	private function mountQuery($stmt, $parameters){
		foreach($parameters as $key => $value){
			$this->setParameters($stmt, $key, $value);
		}
	}

	/*Essa função recebe o pedido a ser feito para o banco de dados e chama a função mountQuery() para preparar os parâmetros a serem usados na requisição.
	$query é o pedido a ser feito
	$parameters são as variáveis a serem utilizadas
	*/
	public function executeQuery(string $query, array $parameters = []){
		$stmt = $this->connection->prepare($query);
		$this->mountQuery($stmt, $parameters);
		$verify = $stmt->execute();
		if($verify == TRUE){
			return $stmt;
		}else{
			return false;
		}
	}

}
?>
