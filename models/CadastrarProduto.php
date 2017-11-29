<?php

require '../config.php';

global $db;


if(isset($_POST['nome_produto']) && !empty($_POST['nome_produto'])){
	if(isset($_POST['valor_produto']) && !empty($_POST['valor_produto'])){
		if(isset($_POST['tipo_produto']) && !empty($_POST['tipo_produto'])){
			if(isset($_POST['descricao_produto']) && !empty($_POST['descricao_produto'])){
					
				$nome_produto = addslashes($_POST['nome_produto']);
				$valor_produto = addslashes($_POST['valor_produto']);
				$tipo_produto = addslashes($_POST['tipo_produto']);
				$descricao_produto = addslashes($_POST['descricao_produto']);
				
				$sql = $db->prepare("INSERT INTO produtos(nome_produto, tipo_produto, valor, descricao, ativo) VALUES (:nome_produto, :tipo_produto, :valor, :descricao, :ativo)");
				$sql->bindValue(':nome_produto', $nome_produto);
				$sql->bindValue(':tipo_produto', $tipo_produto);
				$sql->bindValue('valor', $valor_produto);
				$sql->bindValue('descricao', $descricao_produto);
				$sql->bindValue('ativo', 1);
				$sql->execute();
				
				echo 'Produto cadastrado com sucesso!';				
			}else{
				echo 'Descrição de produto inválido.';
			}			
		}else{
			echo 'Tipo de produto inválido.';
		}
	}else{
		echo 'Valor de produto inválido.';
	}
}else{
	echo 'Nome de produto inválido.';
}
?>