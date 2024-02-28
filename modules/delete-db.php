<?php 
session_start();
require __DIR__ . "/autoloader.php";
	
	if(filter_has_var(INPUT_POST, 'dbname')) {
		
		$dbname = new QueryValidator($_POST['dbname']);

		if($dbname->getResult()) {
			$db = DB::deleteDatabase($dbname->getResult());
			if($db instanceof PDOException) {
				$_SESSION['error'] = $db->getMessage();
			} else if($db) {
				$_SESSION['success'] = 'Database successfully deleted!';
			}
		} else {
			$_SESSION['error'] = "Database can only be alphabets and digits";
		}
	} else {
		$_SESSION['error'] = "Database is not specified!";
	}
	header("location: ../index.php");
?>