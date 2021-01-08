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

	/*Essa função vai receber a query já preparada, e vai percorrer o array dos parâmetros setando cada variável
	da requisição sql para o valor a ser utilizada.
	$stmt é a query já pronta
	$key é a variável da requisição sql
	$value é o valor a ser utilizado na variável
	*/
	public function mountQuery($stmt, $parameters){
		foreach($parameters as $key => $value){
			$stmt->bindParam($key, $value);
		}
	}

	/*Essa função recebe o pedido a ser feito para o banco de dados e chama a função mountQuery() para preparar
	os parâmetros a serem usados na requisição.
	$query é o pedido a ser feito
	$parameters são as variáveis a serem utilizadas
	*/
	public function executeQuery(string $query, array $parameters = []){
		$stmt = $this->connection->prepare($query);
		$this->mountQuery($stmt, $parameters);
		$verify = $stmt->execute();
		if($verify == true){
			return $stmt;
		}else{
			return false;
		}
	}

}
?>