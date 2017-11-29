<?php
require '../config.php';

global $db;

$sql = $db->prepare('SELECT * FROM usuarios WHERE ativo = 1 AND id > 1');
$sql->execute();

if($sql->rowCount() > 0){
	$sql = $sql->fetchAll();
	echo json_encode($sql, JSON_PRETTY_PRINT);
}
?>