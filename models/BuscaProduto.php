<?php

require '../config.php';

global $db;

if(isset($_POST['nome']) && !empty($_POST['nome'])){
	
	$nome = addslashes($_POST['nome']);
	
	$sql = $db->prepare("SELECT * FROM produtos WHERE ativo = 1 AND nome_produto LIKE '%$nome%'");	
	$sql->execute();	
	
	if($sql->rowCount() > 0){
		$sql = $sql->fetchAll();		
		echo json_encode($sql, JSON_PRETTY_PRINT);
	}
}
?>