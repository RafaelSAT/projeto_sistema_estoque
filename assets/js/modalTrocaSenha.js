$(function(){
	
	$('#btnEsqueciSenha').click(function(e){		
		
		e.preventDefault();
		$('#modalTrocaSenha').show();		
		
	});
	
	$('#btnCancelar').click(function(){
		
		$('#modalTrocaSenha').hide();
		
	});
});