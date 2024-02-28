<?php 
function autoloader($className) {
	$file = __DIR__ . '/../services/' . $className . '.php';
	include $file;
}
spl_autoload_register('autoloader');
?>