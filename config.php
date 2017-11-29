<?php

require 'environment.php';

if(ENVIRONMENT == 'desenvolvimento'){
	
	define('BASE_URL', 'http://sistema_estoque.pc/');
	$config = array(
		'dbname' => 'sistema_estoque',
		'dbhost' => 'localhost',
		'dbuser' => 'root',
		'dbpass' => ''
	);	
	
}else{
	
	define('BASE_URL', 'http://projeto_sistema_estoque.pc/');
	$config = array(
		'dbname' => 'sistema_estoque',
		'dbhost' => 'localhost',
		'dbuser' => 'root',
		'dbpass' => ''
	);	
}

global $db;

try{
	
	$db = new PDO('mysql:dbname='.$config['dbname'].';host='.$config['dbhost'], $config['dbuser'], $config['dbpass']);
	
}catch(PDOException $e){
	echo 'ERRO:'.$e->getMessage();
	exit;
}

?>