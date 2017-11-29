$(function(){
	
	$('#form_cadUsuario').on('submit', function(e){
		
		e.preventDefault();
		
		var checado = false;
		
		var usuario = $('input[name=campo_cadUsuario-usuario]').val();
		var senha = $('input[name=campo_cadUsuario-senha]').val();
		var email = $('input[name=campo_cadUsuario-email]').val();
		var permissoes = []	;
		$(document).find('input[type=checkbox]').each(function(){
			
			if($(this).prop("checked")){
				checado = true;
				permissoes += $(this).val();
				permissoes += ' ';
			}
		});
		
		if(checado){
			
			$.ajax({
				type:'POST',
				url:'http://projeto_sistema_estoque.pc/models/CadastrarUsuarios.php',
				data:{usuario:usuario, senha:senha, email:email, permissoes:permissoes},				
				success:function(msgC){
					alert(msgC);
					window.location.href = 'home';
				},
				error:function(e){
					alert(e);
				}
			});
			
		}else{
			alert("Marque uma das opções abaixo.");
		}
	});	
});
