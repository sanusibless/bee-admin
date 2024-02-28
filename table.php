<?php
session_start();

require 'modules/autoloader.php';
$database = DB::getRecordsFromTable($_SESSION['db'], $_GET['table']);

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
			<div style="position:relative;">
			<?php if(is_string($database)) {
				$message = $database;
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
					</ul>
				</div>
		</aside>
		<main class="main">
			<h3 class="title">SQL Browser</h3>
			<div class="query-segment">
				<div class="result">
					<span class="query-db">Database: <span><?=$_SESSION['db'] ?? ""?></span></span>
                    <table>
                        <?php
                        while($result = $database->fetchAll(PDO::FETCH_COLUMN)) { ?>
                        <th>
                            <?= $result ?>
                        </th>
                        <?php } ?>

                    </table>
				</div>
				<div class="query">
					<form action="modules/handlequery.php" method="POST" id="query-form">
						<textarea id="query-input" placeholder="Enter query here" type="text" name="query" cols="150" rows="10"></textarea>
						<div class="query-group"><button id="query-btn">Run</button></div>
					</form>
				</div>
			</div>
		</main>
		<?php
         if(isset($_SESSION['result'])) {
		 if($_SESSION['result']['status'] == 'error') {
					$message = $_SESSION['result']['error'];
				?>
				<div class="overlay">
					<div class="alert-error">
						<h3 style="display: flex;justify-content: space-between; padding: auto 5px;"> 
							<span style="color: black; margin-left: 10px;">Error: </span>
							<span id="close-error">x</span>
						</h3>
						<p> <?=$message ?> </p>
					</div>
				</div>
				<?php } else if ($_SESSION['result']['status'] == 'success') {
					$message = $_SESSION['result']['success'];
				?>
					<div id="alert" class="alert-success">
						<?=$message ?>
					</div>
				<?php } } ?>
	</div>
<script type="text/javascript" src="../public/js/jquery.js"></script>
<script type="text/javascript" src="../public/js/index.js"></script>
<script>
		let forms = document.getElementsByClassName("delete_db");
		forms = Array.from(forms);
		forms.forEach( form => {
			form.addEventListener("submit", (e) => {
				e.preventDefault();
				let check = confirm(`Are you sure you what to run this query?\r\n "DROP DATABASE ${form.dbname.value}"`);
				if(check) {
					form.submit();
				} else {
					return;
				}
			})
		});
</script>
</body>
</html>