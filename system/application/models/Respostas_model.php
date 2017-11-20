<?php 
class Respostas_model extends Model {
	//atributos do modelo
	private $id;
	private $resposta;
	private $fk_id_pergunta;
	
	//Construtor
	function __construct() {
		parent::Model();
	}
	
	function getRespostasPorPergunta($idPergunta){	
		$sql = "select  
					* 
				from 
					respostas
				where
					fk_id_pergunta = ?
				";
		$query = $this->db->query($sql, array($idPergunta));
		
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	
	function excluirRespostasPorPergunta($idPergunta){
		$this->db->where('fk_id_pergunta', $idPergunta);
		$this->db->delete('respostas');
	}
	
	function getVerificaResposta($resposta, $id_pergunta)
	{
		$sql = "select
					*
				from
					respostas
				where
					resposta = ? and fk_id_pergunta = ?";
		$query = $this->db->query($sql, array($resposta, $id_pergunta));
	
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}
	
	function set_id_Pergunta($id_pergunta){
		$this->fk_id_pergunta = $id_pergunta;
	}
	
	function set_Resposta($resposta){
		$this->resposta = $resposta;
	}
	
	function save() {
		// faço o escape dos dados antes da inserção na base de dados
		$this->db->set('resposta', $this->resposta);
		$this->db->set('fk_id_pergunta', $this->fk_id_pergunta, FALSE);
			
		$this->db->insert("respostas");
	}
	
	function getRespostaPorID($id){
		$sql = "select
					*
				from
					respostas
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
	
	function update($id_resposta) {
		// faço o escape dos dados antes da atualização na base de dados
		$this->db->set('resposta', $this->resposta);
		$this->db->where('id',$id_resposta);
		$this->db->update("respostas");
	}
	
	function delete($id_resposta){
		$this->db->where('id', $id_resposta);
		$this->db->delete('respostas');
	}
}
?>