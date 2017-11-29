<?php
require '../config.php';
global $db;

if(isset($_POST['opcaoProdutos']) && !empty($_POST['opcaoProdutos'])){
	
	$opcao = addslashes($_POST['opcaoProdutos']);	
	
	$sql = $db->prepare("SELECT * FROM produtos WHERE ativo = :opcao");
	$sql->bindValue(':opcao', $opcao);
	$sql->execute();
	
	if($sql->rowCount() > 0){
		
		foreach($sql->fetchAll() as $resultado){
			
			$dados_produtos [] = array (
				'nome' => $resultado['nome_produto'],
				'tipo' => $resultado['tipo_produto'],
				'valor' => $resultado['valor'],
				'descricao' => $resultado['descricao']
			);
		}		
	}else{
		echo 'Não há produtos cadastrados!';
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
			<h2>Relatório de Produtos <?php
				if($opcao == 1){
					echo 'Ativos';
				}else{
					echo 'Desativados';
				}
				?>
			</h2>
			<table>
				<tr>
					<th>Nome do Produto</th>
					<th>Tipo do Produto</th>
					<th>Valor</th>
					<th>Descrição</th>
				</tr>
				<?php
					foreach($dados_produtos as $dados){
						?>
						<tr>
							<td><?php echo $dados['nome'];?></td>
							<td><?php echo $dados['tipo'];?></td>
							<td><?php echo $dados['valor'];?></td>
							<td><?php echo $dados['descricao'];?></td>
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