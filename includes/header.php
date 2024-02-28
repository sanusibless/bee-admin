<?php
session_start();

require 'modules/autoloader.php';
$database = DB::getAllDatabases();
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SQL Browser</title>
	<link rel="stylesheet" type="text/css" href="../public/css/styles.css">
</head>
<body>
	<div class="content">
		<aside class="sidebar">
			<div style="position: relative;">
				<?php if(isset($_SESSION['error'])) { 
			$message = $_SESSION['error'];
			unset($_SESSION['error']);
		?>
		<div class="alert-error" id="alert"><?=$message?></div>
		<?php } ?>
	<?php if(isset($_SESSION['success'])){ 
			$message = $_SESSION['success'];
			unset($_SESSION['success']);
		?>
		<div class="alert-success" id="alert"><?=$message?></div>
		<?php } ?>
				<div class="database-header">
					<div class="database-title">
						<h4>Databases</h4>
						<span id="open" title="Create Database">+</span>
						<span id="close" title="Close">x</span>
					</div>
					<div class="create-database-form">
						<form action="modules/create-database.php" method="POST">
						<input type="text" name="database">
						<button value="submit" class="create-button">Create</button>
					</form>
					</div>
				</div>
				<ul>
				<?php while ($db = $database->fetch()) : ?>
					<li class="flex">
						<div class="flex-child"><a href="../modules/handlequery.php?db=<?=$db[0]?>"><?=$db[0]?></a>
						</div>
						<div class="flex-child">
							<form action="/modules/delete-db.php" class="delete_db" method="POST">
								<input type="hidden" name="dbname" value="<?=$db[0]?>">
								<button>
									X
								</button>
							</form>
						</div>

					</li>
				<?php endwhile; ?>
				</ul>
			</div>
		</aside>