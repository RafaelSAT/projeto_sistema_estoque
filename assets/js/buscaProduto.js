function alterarProduto(){
	
		$('.btnAlteraProduto').click(function(e){
		
		e.preventDefault();
		var id = $(this).attr("id");
		
		$('#modalAltProdutos').show();
		
		$('#btn_modalAltCancelarProduto').click(function(){
			$('#modalAltProdutos').hide();
		});
		
		
		$('#btn_modalAlterarProduto').click(function(e){

			e.preventDefault();
			
			var tipo = $('input[name=campo_AltTipoProduto]').val();
			var valor = $('input[name=campo_AltValorProduto]').val();
			var descricao = $('input[name=campo_AltDescricaoProduto]').val();			
			
			$.ajax({
				url:'http://projeto_sistema_estoque.pc/models/AlterarProduto.php',
				type:'POST',
				data:{id:id, tipo:tipo, valor:valor, descricao:descricao},
				success:function(msg){
					alert(msg);
					window.location.href = 'home';
				},
				error:function(e){
					alert(e);
				}
			});
		});
	});	
}

$(function(){
	
	$('#form_BuscaProduto').on('submit', function(e){
		
		e.preventDefault();
		
		var nome = $('input[name=campo_buscaProduto]').val();
		
		$.ajax({
			url:'http://sistema_estoque.pc/models/BuscaProduto.php',
			type:'POST',
			dataType:'json',
			data:{nome:nome},
			success:function(json){
				for(var i = 0; i < json.length; i++){
					$('.tabelaBuscaProduto tbody').append('<tr>'
					+ '<td>' + json[i].id + '</td>'
					+ '<td>' + json[i].nome_produto + '</td>'
					+ '<td>' + json[i].tipo_produto + '</td>'
					+ '<td>' + json[i].valor + '</td>'
					+ '<td>' + json[i].descricao + '</td>'
					+ '<td><input type="button" id='+json[i].id+' class="btnAlteraProduto" value="Alterar"/></td>'
					+ '</tr>'
					);
				}
				alterarProduto();
			},
			error:function(e){
				alert('Nao foi possível realizar a consuta. '+e);
			}
		});
		
	});
});
