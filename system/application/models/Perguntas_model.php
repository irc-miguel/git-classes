<?php 
class Perguntas_model extends Model {
	//atributos do modelo
	private $id;
	private $pergunta;
	private $tipo;
	private $id_enquete;
	
	//Construtor
	function __construct() {
		parent::Model();
	}
	
	function getPerguntasPorEnquete($idEnquete){	
		$sql = "select  
					* 
				from 
					perguntas
				where
					id_enquete = ?
				";
		$query = $this->db->query($sql, array($idEnquete));
		
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	
	function excluirPerguntasPorEnquete($idEnquete){
		$this->db->where('id_enquete', $idEnquete);
		$this->db->delete('perguntas');
	}
	
	function set_id_Enquete($id){		
		$this->id_enquete = $id;
	}
	
	function set_Pergunta($pergunta){
		$this->pergunta = $pergunta;
	}
	
	function set_Tipo_Pergunta($tipo_pergunta){
		$this->tipo = $tipo_pergunta;
	}
	
	function save() {
		// faço o escape dos dados antes da inserção na base de dados
		$this->db->set('pergunta', $this->pergunta);
		$this->db->set('tipo', $this->tipo, FALSE);
		$this->db->set('id_enquete', $this->id_enquete, FALSE);
		 
		$this->db->insert("perguntas");
	}
	
	function getPerguntaPorID($id){
		$sql = "select  
					* 
				from 
					perguntas
				where
					id = ?
				";
		$query = $this->db->query($sql, array($id));
		
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	function getVerificaPergunta($pergunta, $id_enquete)
	{
		$sql = "select
					*
				from
					perguntas
				where
					pergunta = ? and id_enquete = ?";
		$query = $this->db->query($sql, array($pergunta, $id_enquete));
		
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}
	
	function update($id_pergunta) {
		// faço o escape dos dados antes da atualização na base de dados
		$this->db->set('pergunta', $this->pergunta);
		$this->db->set('tipo', $this->tipo, FALSE);		
		$this->db->where('id',$id_pergunta);		 
		$this->db->update("perguntas");
	}
	
	function delete($idPergunta){
		$this->db->where('id', $idPergunta);
		$this->db->delete('perguntas');	
	}
	
}
?>