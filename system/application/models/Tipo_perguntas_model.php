<?php 
class Tipo_perguntas_model extends Model {
	//atributos do modelo
	private $id_tipo;
	private $tipo;
	
	//Construtor
	function __construct() {
		parent::Model();
	}
	
	function getTipoPerguntas(){	
		$sql = "select  
					* 
				from 
					tipo_perguntas
				order by id_tipo desc
				";
		$query = $this->db->query($sql);
		
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	
	function getTipoPorID($id){
		$sql = "select
					*
				from
					tipo_perguntas
				where
					id_tipo = ?
				";
		$query = $this->db->query($sql, array($id));
	
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}
}
?>