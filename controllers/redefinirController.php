<?php

class redefinirController extends Controller{
	
	public function index(){	
		
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email = addslashes($_POST['email']);
			$v = new Redefinir();
			$v->setEmail($email);			
			
			if($v->getToken() == !null){
				$dados = array(
				'token' => $v->getToken(),
				'id' => $v->getId(),
				'usuario' => $v->getUsuario(),
				'email' => $email
				);
				$this->loadView('mensagem',$dados);
			}else{
				echo utf8_decode('E-mail inválido<br/><br/>');
				echo "<a href='login'>Clique aqui para voltar.</a>";
			}	
		}
	}
	
	public function verificaToken($params){
		
		$url = $_GET['url'];
		$url = explode('/', $url);				
		$cod_token = $params;
		
		$info = array(
			'id' => $url[4],
			'usuario' => $url[3],
			'token' => $url[2]
		);		
		$h = new Redefinir();
		$h->setCod_Token($cod_token);		
		$cod_status = $h->getCod_Status();
		
		if($cod_status == 'OK'){
			$this->loadView('alterar', $info);
			
		}else{
			echo utf8_decode('Token inválido ou já foi usado.<br/><br/>');
			header('Location: login');
		}
	}
	
	public function alteraSenha(){
		
		if(isset($_POST['campo_senha']) && !empty($_POST['campo_senha'])){
			
			$id = addslashes($_POST['id']);
			$usuario = addslashes($_POST['usuario']);
			$token = addslashes($_POST['token']);
			$senha = md5(addslashes($_POST['campo_senha']));			
			
			$user = array('usuario' => $usuario);
			
			$r = new Redefinir();
			$r->setSenha($senha, $id, $token);
			$this->loadView('sucesso', $user);
			
		}else{
			
			echo utf8_decode('Senha inválida ou não foi inserida.<br/><br/>');
			header('Location: login');	
		}		
	}
}
?>