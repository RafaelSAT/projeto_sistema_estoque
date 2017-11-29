<?php

require '../config.php';

global $db;

if(isset($_POST['tipo']) && !empty($_POST['tipo'])){
	
	if(isset($_POST['valor']) && !empty($_POST['valor'])){
		
		if(isset($_POST['descricao']) && !empty($_POST['descricao'])){
			
			$id = addslashes($_POST['id']);
			$tipo = addslashes($_POST['tipo']);
			$valor = addslashes($_POST['valor']);
			$descricao = addslashes($_POST['descricao']);
			
			$sql = $db->prepare('UPDATE produtos SET tipo_produto = :tipo, valor = :valor, descricao = :descricao WHERE id = :id');
			$sql->bindValue(':tipo', $tipo);
			$sql->bindValue(':valor', $valor);
			$sql->bindValue(':descricao', $descricao);
			$sql->bindValue(':id', $id);
			$sql->execute();
			
			echo 'Alteração de produto feita com sucesso!';
	
		}else{
			echo 'Descrição inválida.';
		}
	}else{
		echo 'Valor inválido.';
	}	
}else{
	echo 'Tipo inválido.';
}
?>