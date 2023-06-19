<?php
define('USER', 'udi');
define('PASSWORD', '1sl@2020');
define('HOST', '127.0.0.1');
define('DATABASE', 'registrolab');
try{
	
	$connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD, array(PDO::ATTR_PERSISTENT => false));
	
} catch(PDOException $exc){
	$connection = null;
	exit($exc -> getMessage());
}
?>
