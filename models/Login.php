<?php

session_start();
require '../config.php';

global $db;


if(isset($_POST['usuario']) && !empty($_POST['usuario'])){
	
	if(isset($_POST['senha']) && !empty($_POST['senha'])){
		
		$usuario = addslashes($_POST['usuario']);
		$senha = md5(addslashes($_POST['senha']));
		
		$status = '';
		
		$sql = $db->prepare('SELECT * FROM usuarios WHERE nome_usuario = :usuario AND senha = :senha');
		$sql->bindValue(':usuario', $usuario);
		$sql->bindValue(':senha', $senha);
		$sql->execute();
		
		if($sql->rowCount() >0){
			
			$sql = $sql->fetch();
			$_SESSION['id'] = $sql['id'];
			$_SESSION['usuario'] = $sql['nome_usuario'];
			$_SESSION['permissoes'] = $sql['permissoes'];
			$ativo = $sql['ativo'];
			
			if($ativo == 1){
				$status = 1;
				echo $status;
			}else{
				$status = 3;
				echo $status;
			}
			
		}else{
			$status = 2;
			echo $status;
		}
		
	}else{
		echo 'Usuário ou Senha incorretos';
	}
}else{
	echo 'Usuário ou Senha incorretos';
}

?>