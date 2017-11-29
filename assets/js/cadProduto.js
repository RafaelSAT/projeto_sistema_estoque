$(function(){
	
	$('#form_cadProduto').on('submit', function(e){
		
		e.preventDefault();
		
		var nome_produto = $('input[name=campo_nomeProduto]').val();
		var valor_produto = $('input[name=campo_valorProduto]').val();
		var tipo_produto = $('input[name=campo_tipoProduto]').val();
		var descricao_produto = $('input[name=campo_descricaoProduto]').val();
		
		$.ajax({
			url:'http://projeto_sistema_estoque.pc/models/CadastrarProduto.php',
			type:'POST',
			data:{nome_produto:nome_produto, valor_produto:valor_produto, tipo_produto:tipo_produto, descricao_produto:descricao_produto},
			success:function(msg){
				alert(msg);
				window.location.href = 'home';
			},
			error:function(e){
				alert("Não foi possível realizar o cadastro do produto.");
			}
		});
		
	});
	
});
