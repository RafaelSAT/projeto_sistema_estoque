<?php
require '../config.php';
global $db;

if(isset($_POST['opcaoUsuarios']) && !empty($_POST['opcaoUsuarios'])){
	
	$opcao = addslashes($_POST['opcaoUsuarios']);	
	
	$sql = $db->prepare("SELECT * FROM usuarios WHERE ativo = :opcao AND id > 1");
	$sql->bindValue(':opcao', $opcao);
	$sql->execute();
	
	if($sql->rowCount() > 0){
		
		foreach($sql->fetchAll() as $resultado){
			
			$dados_usuarios [] = array (
				'nome' => $resultado['nome_usuario'],
				'email' => $resultado['email'],
				'permissoes' => $resultado['permissoes']
			);
		}		
	}
	else{
		echo 'Não há usuários cadastrados.';
		exit;
	}
	
	ob_start();
?>
	<DOCTYPE>
	<html>
		<head>
			<link rel='stylesheet' type='text/css' href='<?php echo BASE_URL;?>assets/css/rel.css'/>
		</head>
		<body>
			<h2>Relatório de Usuarios <?php
				if($opcao == 1){
					echo 'Ativos';
				}else{
					echo 'Desativados';
				}
				?>
			</h2>
			<table>
				<tr>
					<th>Nome do Usuário</th>
					<th>Email</th>
					<th>Permissões</th>
				</tr>
				<?php
					foreach($dados_usuarios as $dados){
						?>
						<tr>
							<td><?php echo $dados['nome'];?></td>
							<td><?php echo $dados['email'];?></td>
							<td><?php echo $dados['permissoes'];?></td>
						</tr>
						<?php
					}
				?>
			</table>
		</body>
	</html>
<?php	
	$html = ob_get_contents();
	ob_end_clean();
	require '../vendor/autoload.php';
	$mpdf = new mPDF();
	$mpdf->WriteHTML($html);
	$mpdf->Output();
}else{
	echo 'Selecione uma opção';
}
?>