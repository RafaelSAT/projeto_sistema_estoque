<?php
require '../config.php';

global $db;

$ativo = $_POST['ativo'];
$id = $_POST['id'];

$sql = $db->prepare("UPDATE produtos SET ativo = :ativo WHERE id = :id");
$sql->bindValue(':ativo', $ativo);
$sql->bindValue(':id', $id);
$sql->execute();

echo 'Produto excluido com sucesso!';
?>
