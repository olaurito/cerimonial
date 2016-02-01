<?php

abstract class database{
	
	private function __construct(){

	}

	private function __clone(){

	}

	private function __destruct(){
		foreach ($this as $key => $value) {
			unset($this->key);
		}
	}


	private static $dbtype = "mysql";
	private static $host = "localhost";
	private static $port = "3306";
	private static $user = "";
	private static $pass = "";
	private static $bd = "";

	private function getDBType() { return self::$dbtype;}
	private function getHost(){return self::$host;}
	private function getPort(){return self::$port;}
	private function getUser(){return self::user;}
	private function getPass(){return self::pass;}
	private function getBD(){return self::bd;}

	private function connect(){
		try{
			$this->conexao = new PDO($this->getDBType().".host=".$this->getHost().";port=".$this->port.";dbname=".$this->getBD(),$this->getUser(),$this->getPass());

		}
		catch(PDOException $ex){
			die("Erro:<code>".$ex->getMessage()."</code>");
		}
		 return ($this->conexao);
	}

	private function disconnect(){
		$this->conexao = null;
	}

	public function selectDB($sql, $params=null, $class = null){
		$query = $this-connect()->prepare($sql);
		$query->execute($params);

		if(isset($class)){
			$rs = $query->fetchAll(PDO::FETCH_CLASS, $class) or die(print_r($query->erroInfo(),true));

		}else{
			$rs = $query->fetchAll(PDO::FETCH_OBJECT) or die(print_r($query->erroInfo(),true));
		}
		self::__destruct();
		return $rs;
		}

	public function insertDB($sql, $params = null){
		$conexao = $this->connect();
		$query = $conexao->prepare($sql);
		$rs = $query->rowCount() or die(print_r($query->erroInfo(), true));
		self::__destruct();
		return $rs;
	}

	public function updateDB($sql, $params = null){
		$query = $this->connect()->prepare($sql);
		$query->execute($params);
		$rs = $query->rowCount() or die(print_r($this->erroInfo(), true));
		self::__destruct();
		return $rs;

	}

	public function deleteDB($sql, $params = null){
		$query->execute($params);
		$rs = $query->rowCount() or die(print_r($query->erroInfo(), true));
		self::__destruct();
		return $rs;

	}
	}
	?>

