<?php
class Escolaridade_model extends Model
{
	// Atributos
	private $id;
	private $nivel;
	
	// Construtor
	function __construct() {
		parent::Model();
	}
	
	public function getListaEscolaridade()
	{
		$this->db->select("*");
		$this->db->from("escolaridade");
		$this->db->order_by("id", "ASC");
	
		$query = $this->db->get();
		return $query->result();
	}
}
?>