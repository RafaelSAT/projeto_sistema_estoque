$(function(){
	
	$('#form-relUsuarios').on('submit', function(e){
		e.preventDefault();		
		
		$(document).find('input[name=opcaoUsuarios]').each(function(){
			if($(this).prop("checked")){
				var opcao = $(this).val()
				
				$.ajax({
					url:'http://sistema_estoque.pc/models/RelUsuarios.php',
					data:{opcao:opcao},
					type:'POST',
					success:function(msg){
						window.location.href = 'http://sistema_estoque.pc/models/RelUsuarios.php';
					},
					error:function(e){
						alert('Não foi possível gerar relatório. '+e);
					}
				});
			}
		});		
	});	
});