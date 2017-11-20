<?php 
class Enquetes_model extends Model {
	//atributos do modelo
	private $id;
	private $titulo;
	private $descricao;
	private $data_cadastro;
	private $autor;
	
	//Construtor
	function __construct() {
		parent::Model();
	}
	
	function getEnquetes()
	{	
		$sql = "select  
					* 
				from 
					enquetes
				order by id desc";
		$query = $this->db->query($sql);
		
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	
	function getEnquetePorTitulo($titulo)
	{
		$sql = "select 
					* 
				from
					enquetes
				where
					titulo = ? ";
		$query = $this->db->query($sql, array($titulo));
		
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;		
	}
	
	function setTitulo($titulo){		
		$this->titulo = $titulo;
	}
	
	function setDescricao($descricao){		
		$this->descricao = $descricao;
	}
	
	function setData($data_cadastro){
		$this->data_cadastro = $data_cadastro;
	}
	
	function setAutor($id_autor){
		$this->autor = $id_autor;
	}
	
	function save() {
		// faço o escape dos dados antes da inserção na base de dados
		$this->db->set('titulo', $this->titulo);
		$this->db->set('descricao', $this->descricao);
		$this->db->set('data_cadastro', $this->data_cadastro);
		$this->db->set('autor', $this->autor, FALSE);
		 
		$this->db->insert("enquetes");
	}
	
	function getEnquetePorID($id)
	{
		$sql = "select 
					* 
				from
					enquetes
				where
					id = ? ";
		$query = $this->db->query($sql, array($id));
		
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;		
	}
	
	function update($id_enquete) {
		// faço o escape dos dados antes da atualização na base de dados
		$this->db->set('titulo', $this->titulo);
		$this->db->set('descricao', $this->descricao);
		$this->db->where('id',$id_enquete);		 
		$this->db->update("enquetes");
	}
	
	function delete($idEnquete) {
		$this->db->where('id', $idEnquete);
		$this->db->delete('enquetes'); 
	}
	
}
?>