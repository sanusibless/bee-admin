<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === "GET") {
		$db =  $_GET['db'];
		executeQuery($db,"SHOW TABLES");
} else if($_SERVER['REQUEST_METHOD'] === "POST") {
	$query = $_POST['query'];
	$queryArray = explode(';', $query);
	$ans = preg_match('/^use\s\w+$/i', $queryArray[0]);
	if($ans) {
		$db = explode(" ", $queryArray[0])[1];
		if(count($queryArray) >= 1) {
			$start = strpos($_POST['query'],';');
			$query = substr($_POST['query'], $start+2);
			executeQuery($db, $query);
		} else {
			executeQuery($db, $_POST['query']);
		}
	} else {
		executeQuery($_SESSION['db'],$_POST['query']);
	}
}

header("location: ../index.php");

function executeQuery($db,$query) {
	try {

		$pdo = new PDO("mysql:host=localhost;dbname=$db;charset=utf8;",'root','');
		$result = $pdo->query($query);
		if($result !== null) {
		$columns = [];
		$columnCount = $result->columnCount();
		for($i = 0; $i < $columnCount; $i++) {
			$columns[] = $result->getColumnMeta($i)['name'];
		}
		$data = [];
		while($res = $result->fetch()) {
			$data[] = $res;
		}
	}
		$_SESSION['db'] = $db;
		$_SESSION['result']['status'] = 'success';
		$_SESSION['result']['success'] = 'Query successful!';
		$_SESSION['result']['columns'] = $columns ?? "";
		$_SESSION['result']['data'] = $data ?? ""; 
	} catch(PDOException $e) {
		$_SESSION['result']['status'] = 'error';
		$_SESSION['result']['error'] = $e->getMessage();
	}
}
