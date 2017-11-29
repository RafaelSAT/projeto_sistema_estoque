<?php

require '../config.php';

global $db;

if(isset($_POST['usuario']) && !empty($_POST['usuario'])){
	
	if(isset($_POST['senha']) && !empty($_POST['senha'])){
		
		if(isset($_POST['permissoes']) && !empty($_POST['permissoes'])){
			
			if(isset($_POST['email']) && !empty($_POST['email'])){
				
				$usuario = addslashes($_POST['usuario']);
				$senha = md5(addslashes($_POST['senha']));
				$email = addslashes($_POST['email']);
				$permissoes = addslashes($_POST['permissoes']);
				
				$sql = $db->prepare("INSERT INTO usuarios (nome_usuario, senha, email, ativo, permissoes) VALUES (:nome_usuario, :senha, :email, :ativo, :permissoes)");
				$sql->bindValue(':nome_usuario', $usuario);
				$sql->bindValue('senha', $senha);
				$sql->bindValue('email', $email);
				$sql->bindValue('ativo', 1);
				$sql->bindValue('permissoes', $permissoes);
				$sql->execute();
				
				echo 'Usuário cadastrado com sucesso!';
			}else{
				echo 'Campo E-mail inválido ou não preenchido.';
			}
			
		}else{
			echo 'Campo Permissoes inválido ou não preenchido';
		}
		
	}else{
		echo 'Campo Senha inválido ou não preenchido.';
	}
	
}else{
	echo 'Campo Usuário inválido ou não preenchido.';
}
?>