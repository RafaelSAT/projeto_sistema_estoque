function excluiProduto(){
	
		$('.btnExcluiProduto').click(function(e){
		
		e.preventDefault();
		var id = $(this).attr("id");
		
		$('#modalExcProdutos').show();
		
		$('#btnExcNProduto').click(function(){
			$('#modalExcProdutos').hide();
		});
		
		
		$('#btnExcSProduto').click(function(e){

			e.preventDefault();						
			
			var ativo = 2;
			
			$.ajax({
				url:'http://sistema_estoque.pc/models/ExcluirProduto.php',
				type:'POST',
				data:{id:id, ativo:ativo},
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
	
	$('#form_excProduto').on('submit', function(e){
		
		e.preventDefault();
		
		var nome = $('input[name=campo_buscaExcProduto]').val();
		
		$.ajax({
			url:'http://sistema_estoque.pc/models/BuscaProduto.php',
			type:'POST',
			dataType:'json',
			data:{nome:nome},
			success:function(json){
				for(var i = 0; i < json.length; i++){
					$('.tabelaExcluirProduto tbody').append('<tr>'
					+ '<td>' + json[i].id + '</td>'
					+ '<td>' + json[i].nome_produto + '</td>'
					+ '<td>' + json[i].tipo_produto + '</td>'
					+ '<td>' + json[i].valor + '</td>'
					+ '<td>' + json[i].descricao + '</td>'
					+ '<td><input type="button" id='+json[i].id+' class="btnExcluiProduto" value="Excluir"/></td>'
					+ '</tr>'
					);
				}
				
				excluiProduto();
			},
			error:function(e){
				alert('Nao foi possível realizar a consulta. '+e);
			}
		});
		
	});
});