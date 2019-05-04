<?php 

class model{
	public $pdo;
	public function __construct(){
	$this->pdo = new PDO("mysql:dbname=".DB_NAME.";".DB_HOST, DB_USER ,DB_PASS);
	}

}


?>