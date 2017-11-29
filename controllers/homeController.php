<?php

class homeController extends Controller{
	
	public function index(){
		
		if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
			
			$dados = array(
				'id' => $_SESSION['id'],
				'usuario' => $_SESSION['usuario'],
				'permissoes' => $_SESSION['permissoes']
			);
			
			$this->loadView('home', $dados);
		}else{
			$this->loadView('login');
		}	
	}	
}
?>