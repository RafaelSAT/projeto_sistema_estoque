<?php

class Redefinir extends Model{
	
	private $email;
	private $id;
	private $usuario;
	private $token;
	private $cod_token;
	private $cod_status;
	private $senha;
	
	public function __construct(){
		parent::__construct();
	}
	
	private function verificaEmail(){
		
		$sql = $this->db->prepare('SELECT * FROM usuarios WHERE email = :email');
		$sql->bindValue(':email', $this->email);
		$sql->execute();
		
		if($sql->rowCount() > 0){
			$sql = $sql->fetch();
			$this->id = $sql['id'];
			$this->usuario = $sql['nome_usuario'];
			$this->geraToken();
		}else{
			$this->token = null;
		}
	}
	
	private function verificaHash(){
		
		$sql = $this->db->prepare('SELECT * FROM senha_token WHERE hash = :hash AND usado = 1 AND expirado_em > NOW()');
		$sql->bindValue(':hash', $this->cod_token);
		$sql->execute();
		
		if($sql->rowCount() > 0){			
			$this->cod_status = 'OK';
		}else{
			$this->cod_status = 'ERRO';
		}
	}
	
	private function geraToken(){
		$this->token = md5(time().rand(0,9999).rand(0,9999));
			
		$sql = $this->db->prepare('INSERT INTO senha_token (id_usuario, hash, expirado_em) VALUES (:id_usuario, :hash, :expirado_em)');
		$sql->bindValue(':id_usuario', $this->id);
		$sql->bindValue(':hash', $this->token);
		$sql->bindValue(':expirado_em', date('Y-m-d H:i', strtotime('+1 hours')));
		$sql->execute();
	}
	
	private function alteraSenha(){
		
		$sql = $this->db->prepare('UPDATE usuarios SET senha = :senha WHERE id = :id');
		$sql->bindValue(':senha', $this->senha);
		$sql->bindValue(':id', $this->id);
		$sql->execute();
		
		$sql = $this->db->prepare('UPDATE senha_token SET usado = 2 WHERE hash = :token');
		$sql->bindValue(':token', $this->token);
		$sql->execute();
	}

	public function getUsuario(){
		return $this->usuario;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getToken(){
		return $this->token;
	}
	
	public function getCod_Status(){
		return $this->cod_status;		
	}
	
	public function setEmail($email){
		$this->email = $email;
		$this->verificaEmail();
	}
	
	public function setCod_Token($cod_token){
		$this->cod_token = $cod_token;
		$this->verificaHash();
	}
	
	public function setSenha($senha, $id, $token){
		$this->senha = $senha;
		$this->id = $id;
		$this->token = $token;
		$this->alteraSenha();
	}
}
?>