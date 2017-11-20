<?php
class Cidades_model extends Model 
{
	// Atributos
	private $id_cidade;
	private $nome_cidade;
	private $fk_id_estado;

	// Construtor
	function __construct() {
		parent::Model();
	}
	
	public function getListaCidadesPorIdEstado($idEstado)
	{
		$this->db->select('*');
		$this->db->from('cidades');
		$this->db->where("fk_id_estado",$idEstado);
		$this->db->order_by("nome","ASC");
		
		$query = $this->db->get_where();
		return $query->result();
	}
	
	public function getCidadePorId($idCidade)
	{
		$this->db->select('*');
		$this->db->from('cidades');
		$this->db->where("id",$idCidade);
		
		$query = $this->db->get_where();
		return $query->row();
	}
}
?>