<?php
session_start();
require __DIR__ . "/autoloader.php";

if(filter_has_var(INPUT_POST, 'database')) {
	$dbname = new QueryValidator($_POST['database']);

	if($dbname->getResult()) {
		$db = DB::createDatabase($dbname->getResult());
		if($db instanceof PDOException) {
			echo $db->getMessage();
		} else if($db) {
			$_SESSION['success'] = 'Database created successfully';
			header("location: ../index.php");
		}
	} else {
		$_SESSION['error'] = "Database name can only be alphabets and digits";
		header("location: ../index.php");
	}
}

?>