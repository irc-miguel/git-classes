<?php 
class Resultado_pesquisas_model extends Model {
	//atributos do modelo
	private $id;
	private $enquete_id;
	private $pergunta_id;
	private $resposta_id;
	private $usuario_cliente_id;
	private $data_resposta_usuario;
	
	//Construtor
	function __construct() {
		parent::Model();
	}
	
	function getResultadoPesquisas()
	{
		$sql = "select
					*
				from
					resultado_pesquisas
				order by id desc";
		$query = $this->db->query($sql);
	
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	
	//Verifica quais pesquisas o usuário respondeu
	function verificaUsuario($id_usuario, $id_enquete)
	{
		$sql = "select
					*
				from
					resultado_pesquisas
				where
					usuario_cliente_id = ? and enquete_id = ? ";
		$query = $this->db->query($sql, array($id_usuario, $id_enquete));
		
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}
	
	function set_id_Enquete($enquete_id){
		$this->enquete_id = $enquete_id;
	}
	
	function set_id_Pergunta($pergunta_id){
		$this->pergunta_id = $pergunta_id;
	}
	
	function set_id_Resposta($resposta_id){
		$this->resposta_id = $resposta_id;
	}
	
	function set_id_Usuario($usuario_cliente_id){
		$this->usuario_cliente_id = $usuario_cliente_id;
	}
	
	function set_DataResposta($data_resposta_usuario){
		$this->data_resposta_usuario = $data_resposta_usuario;
	}
	
	function save() {
		// faço o escape dos dados antes da inserção na base de dados
		$this->db->set('enquete_id', $this->enquete_id, FALSE);
		$this->db->set('pergunta_id', $this->pergunta_id, FALSE);
		$this->db->set('resposta_id', $this->resposta_id, FALSE);
		$this->db->set('usuario_cliente_id', $this->usuario_cliente_id, FALSE);
		$this->db->set('data_resposta_usuario', $this->data_resposta_usuario);
			
		$this->db->insert("resultado_pesquisas");
	}
	
	function getQuantidadeResposta($resposta_id)
	{
		$sql = "select
					count(*) as TOTAL
				from
					resultado_pesquisas
				where
					resposta_id = ?";
		$query = $this->db->query($sql, array($resposta_id));
		
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}
	
	function getResultadoPorEnquete($enquete_id){
		$sql = "select
					*
				from
					resultado_pesquisas
				where
					enquete_id = ?
				";
		$query = $this->db->query($sql, array($enquete_id));
	
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	
	function getEstatisticasUsuariosPesquisa($enquete_id)
	{
		$sql = "select distinct
					rp.usuario_cliente_id, u.*, e.nivel as nivel_escolaridade
				from
					resultado_pesquisas rp
				join usuario u
					on u.id_usuario = rp.usuario_cliente_id
				join escolaridade e
					on e.id = u.escolaridade
				where
					rp.enquete_id = ?
				";
		$query = $this->db->query($sql, array($enquete_id));
		
		//verifica se houve resultados
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	
	function delete($enquete_id) {
		$this->db->where('enquete_id', $enquete_id);
		$this->db->delete('resultado_pesquisas');
	}
}
?>