<?php

class DB {
	private $connection;
	private $error;
	private $result;

	public function __construct($hostname)
	{
		try {

			$pdo = new PDO("mysql:host=$hostname;charset=utf8", 'root', '');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connection = $pdo;
		} catch(PDOException $e ) {
			$this->error = $e->getMessage();
		}
	}

	public function query($query) {

		try {
			$this->result = $this->connection->query($query);
		} catch(PDOException $e) {
			$this->error = $e;
		}

		return $this;
	}

	public function getResult() {
		return $this->result;
	}
	public function getError(){
		return $this->error;
	}

	public static function setUpConnection() {
		$db = new PDO("mysql:host=localhost;charset=utf8",'root', '');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $db;
	}

	public static function getAllDatabases() {
		try {
			$db = self::setUpConnection();
			return $db->query("SHOW DATABASES");
		} catch(PDOException $e) {
			return $e;
		}
	}

	public static function createDatabase($dbname) {
		try {
			$db = self::setUpConnection();
			$db->exec("CREATE DATABASE $dbname");
			return true;
		} catch (PDOException $e) {
			return $e;
		}
	}

	public static function deleteDatabase($dbname) {
		try{
			$db = self::setUpConnection();
			$db->exec("DROP DATABASE $dbname");
			return true;
		} catch(PDOException $e) {
			return $e;
		}
	}

	public static function changeDB($dbname) {
		//$this->
	}
}

?>