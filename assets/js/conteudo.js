$(function(){
	
	$('.coluna-conteudo').hide();
	
	$('.botao').click(function(){		
		
		$('.conteudo').each(function(){
			$(this).hide();
		});
		
		$('.coluna-conteudo').show();
		
		var idBotao = this.id;
		
		$('.conteudo').each(function(){
			
			var id = this.id;
			
			if(id == idBotao){
				$(this).show("slow");
			}
		});
	});	
});