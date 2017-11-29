<?php
require '../config.php';

global $db;

$email = addslashes($_POST['email']);
$id = addslashes($_POST['id']);

if(isset($email) && !empty($email)){
		
	$sql = $db->prepare("UPDATE usuarios SET email = :email WHERE id = :id");
	$sql->bindValue(':email', $email);
	$sql->bindValue(':id', $id);
	$sql->execute();
	
	echo 'E-mail alterado com sucesso!';
	
}else{	
	echo 'Campo de e-mail inválido';
}
?>