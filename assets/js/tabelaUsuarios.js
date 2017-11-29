function Alterar(){

	$('.btnTabelaUsuarios').click(function(e){

		e.preventDefault();		
		var id = $(this).attr("id");
		
		$('#modalAltUsuarios').show();
		
		$('#btnCancelarUsuario').click(function(){
			$('#modalAltUsuarios').hide();
		});
		
		
		$('#form-modalAltUsuarios').on('submit', function(){
			
			var email = $('input[name=campo_AltEmail]').val();
			
			$.ajax({
				url:'http://projeto_sistema_estoque.pc/models/AlteraUsuario.php',
				type:'POST',
				data:{email:email, id:id},
				success:function(msgE){
					alert(msgE);
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
	
	$('.tabelaUsuarios').ready(function(){
		
		$.ajax({
			url:'http://projeto_sistema_estoque.pc/models/TabelaUsuarios.php',
			type:'POST',
			dataType:'json',
			success:function(json){
				for(var i = 0; i < json.length; i++){
					$('.tabelaUsuario').append('<tr>'
					+ '<td>' + json[i].nome_usuario + '</td>'
					+ '<td>' + json[i].email + '</td>'
					+ '<td><input type="button" id='+json[i].id+' class="btnTabelaUsuarios" value="Alterar"/></td>'
					+ '</tr>');					
				}
				Alterar();
			},
		});		
	});
});
