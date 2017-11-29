function excluir(){

	$('.btnExluirUsuarios').click(function(e){
		
		e.preventDefault();
		var id = $(this).attr("id");
		
		$('#modalExcUsuarios').show();
		
		$('#btnExcNUsuario').click(function(){
			$('#modalExcUsuarios').hide();
		});
		
		
		$('#btnExcSUsuario').click(function(){
			
			var ativo = 3;
			
			$.ajax({
				url:'http://projeto_sistema_estoque.pc/models/ExcluirUsuario.php',
				type:'POST',
				data:{ativo:ativo, id:id},
				success:function(msgEx){
					alert(msgEx);
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
	
	$('.tabelaExcUsuario').ready(function(){
		
		$.ajax({
			url:'http://projeto_sistema_estoque.pc/models/TabelaUsuarios.php',
			type:'POST',
			dataType:'json',
			success:function(json){
				for(var i = 0; i < json.length; i++){
					$('.tabelaExcUsuario').append('<tr>'
					+ '<td>' + json[i].nome_usuario + '</td>'
					+ '<td>' + json[i].email + '</td>'
					+ '<td><input type="button" id='+json[i].id+' class="btnExluirUsuarios" value="Excluir"/></td>'
					+ '</tr>');					
				}

				excluir();
			},
		});		
	});
});
