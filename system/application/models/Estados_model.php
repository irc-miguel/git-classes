<?php
class Estados_model extends Model 
{
	// Atributos
	private $id;
	private $nome;
	private $sigla;

	// Construtor
	function __construct() {
		parent::Model();
	}
	
	public function getListaEstados()
	{	
		$this->db->select("*");
		$this->db->from("estados");
		$this->db->order_by("nome", "ASC");
		
		$query = $this->db->get();		
		return $query->result();
	}
	
	public function getEstadoPorId($idEstado)
	{
		$this->db->select("*");
		$this->db->from("estados");
		$this->db->where("id",$idEstado);
		
		$query = $this->db->get();
		return $query->row();
	}
}
?>