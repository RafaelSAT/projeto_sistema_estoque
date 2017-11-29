$(function(){
	
	$('#formLogin').on('submit', function(e){
		
		e.preventDefault();
		var usuario = $('input[name=campo_usuario]').val();
		var senha = $('input[name=campo_senha]').val();
	
		$.ajax({
			url:'http://projeto_sistema_estoque.pc/models/Login.php',
			type:'POST',
			data:{usuario:usuario, senha:senha},
			cache:false,
			success:function(msg){
				
				if(msg == 1){
					window.location.href = 'home';
				}
				if(msg == 2) {
					alert("Usuário ou Senha inválidos");
				}
				if(msg == 3){
					alert('Usuário Desativado!');
				}
			},
			error:function(e){
				alert("Erro ao logar."+e);
			}
		});
	});	
});
