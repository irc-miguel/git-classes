<?php
class Usuario_model extends Model {
	//atributos do modelo
	private $id_usuario;
	private $nome;
	private $email_usuario;
	private $senha;
	private $cod_cidade;
	private $cep;
	private $sexo;
	private $data_nascimento;
	private $escolaridade;
	private $admin;

	//Construtor
	function __construct() {
		parent::Model();
	}
	
	function buscaUsuarioPorEmail($email)
	{	
		$sql = "select  
					* 
				from 
					usuario 
				where 
					email_usuario = ? ";
		$query = $this->db->query($sql, array($email));
		
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}
	
	function buscaUsuarioPorId($id)
	{	
		$sql = "select  
					* 
				from 
					usuario 
				where 
					id_usuario = ? ";
		$query = $this->db->query($sql, array($id));
		
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}
	
	//insere o registro do usuário
	function save() {
		// faço o escape dos dados antes da inserção na base de dados
		$this->db->set('nome', $this->nome);
		$this->db->set('email_usuario', $this->email_usuario);
		$this->db->set('senha', $this->senha);
		$this->db->set('cod_cidade', $this->cod_cidade, FALSE);
		$this->db->set('cep', $this->cep);
		$this->db->set('sexo', $this->sexo);
		$this->db->set('data_nascimento', $this->data_nascimento);
		$this->db->set('escolaridade', $this->escolaridade);
		 
		$this->db->insert("usuario");
	}		
	
	function setIdUsuario($id){		
		$this->id_usuario = isset($id) ? $id : NULL;
	}
	
	function setNome($nome){		
		$this->nome = isset($nome) ? $nome : NULL;
	}
	
	function setEmail($email){		
		$this->email_usuario = isset($email) ? $email : NULL;
	}
	
	function setCidade($cidade){		
		$this->cod_cidade = isset($cidade) ? $cidade : NULL;
	}
	
	function setCep($cep){		
		$this->cep = isset($cep) ? $cep : NULL;
	}
	
	function setSexo($sexo){		
		$this->sexo = isset($sexo) ? $sexo : NULL;
	}
	
	function setDataNascimento($data_nascimento){		
		//converto data para inserção no banco de dados
		if($data_nascimento){
			$data_nasc = explode('/', $data_nascimento);					
			$dt_nasc = $data_nasc[2]."-".$data_nasc[1]."-".$data_nasc[0];
		} else {
			$dt_nasc = NULL;
		}		
		$this->data_nascimento = $dt_nasc;
	}
	
	function setEscolaridade($escolaridade){
		$this->escolaridade = isset($escolaridade) ? $escolaridade : NULL;
	}
	
	function setSenha($senha){		
		
		if($senha){
		//faço a encriptação da senha antes de salvar na base de dados
			$senha_criptografada = $this->encrypt->encode($senha);
		} else {
			$senha_criptografada = NULL;
		}			
		$this->senha = $senha_criptografada;
	}
	
	function buscaAdminPorEmail($email){
		$sql = "select  
					* 
				from 
					usuario 
				where 
					email_usuario = ? AND admin = true";
		$query = $this->db->query($sql, array($email));
		
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}
	
	//atualiza os dados do usuário
	function update() {
		// faço o escape dos dados antes da inserção na base de dados
		$this->db->set('nome', $this->nome);
		$this->db->set('email_usuario', $this->email_usuario);
		$this->db->set('senha', $this->senha);
		$this->db->set('cod_cidade', $this->cod_cidade, FALSE);
		$this->db->set('cep', $this->cep);
		$this->db->set('sexo', $this->sexo);
		$this->db->set('data_nascimento', $this->data_nascimento);
		$this->db->set('escolaridade', $this->escolaridade);
		
		$this->db->where('id_usuario', $this->id_usuario);
		$this->db->update('usuario', $this); 
	}
}
?>