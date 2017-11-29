function permissao(){
	
	$('.itens-menu').each(function(){
		$(this).hide();
	});
	
	var permissao = $(document).find('input[name=permissoes]').val();	
	var p = permissao.split(' ');
	
	$('#itens-produtos').show();
	$('#cadProduto').hide();
	$('#altProduto').hide();
	$('#excProduto').hide();
	
	for(var i = 0; i < p.length;i++){
		
		if(p[i] == 'ADD'){			
			$(document).find('#cadProduto').show();
		}
		if(p[i] == 'EDIT'){			
			$(document).find('#altProduto').show();
		}
		if(p[i] == 'DEL'){			
			$(document).find('#excProduto').show();
		}
		if(p[i] == 'VER'){
			$(document).find('#itens-relatorios').show();
		}
		if(p[i] == 'CONTROL'){
			$('.itens-menu').each(function(){
				$(this).show();			
			});
			
			$('#cadProduto').show();
			$('#altProduto').show();
			$('#excProduto').show();
		}
	}
	
}