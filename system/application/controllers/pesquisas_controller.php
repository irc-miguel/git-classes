<?php
class Pesquisas_controller extends Controller {

	function Pesquisas_controller() {
		parent::Controller();
		//carrego as models
		$this->load->model("Usuario_model");
		$this->load->model("Enquetes_model");
		$this->load->model("Perguntas_model");
		$this->load->model("Respostas_model");
		$this->load->model("Resultado_pesquisas_model");
		
		//carrego a sessão
		$this->sessao = $this->session->userdata;
		$this->usuario_id = $this->sessao['id_usuario'];
		
		//verifica se o usuário está logado
		if (!isset($this->sessao['logado'])) {
			$obj =& get_instance();
			$obj->session->set_userdata('_url_', $_SERVER['REQUEST_URI']);			
			redirect('/usuario_controller/login');
		} else {
			// verifico se usuario possui perfil de admin
			if($this->sessao['admin'] == true){
				redirect('/usuario_controller/login');
			}
		}
	}
	
	function index() 
	{
		$resultado_pesquisa_model = new Resultado_pesquisas_model();
		$enquetes_model 		  = new Enquetes_model();
		$this->enquetes = $enquetes_model->getEnquetes();
		
		foreach($this->enquetes as $enquete)			
		{			
			$result = $resultado_pesquisa_model->verificaUsuario($this->sessao['id_usuario'], $enquete->id);
			
			if($result)
				$enquete->respondida = true;
			else
				$enquete->respondida = false;
		}
		
		$this->titulo = 'Pesquisas - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
		$this->aba = 'pesquisa';
		parseSmarty("pesquisas.tpl");
	}
	
	function responder_pesquisa($id)
	{
		if($id)
		{
			$enquetes_model = new Enquetes_model();
			$enquete = $enquetes_model->getEnquetePorID($id);
			$perguntas = false;
			
			//caso possua enquete
			if($enquete)
			{
				//verifico se possui perguntas
				$perguntas_model = new Perguntas_model();
				$perguntas = $perguntas_model->getPerguntasPorEnquete($enquete->id);
				
				//caso possuir perguntas, verifico se possui respostas
				if($perguntas){
					$respostas_model = new Respostas_model();
					foreach($perguntas as $perg){
						$respostas = $respostas_model->getRespostasPorPergunta($perg->id);
						$perg->respostas = $respostas;
					}
				}
				
				$this->titulo = 'Responder Pesquisa - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
				$this->aba = 'pesquisa';
				$this->enquete = $enquete;
				$this->perguntas = $perguntas;
				View::montaTemplate("visualizar_pesquisa.tpl");
			}
			//senão redireciono para listagem de pesquisas
			else {
				redirect("/pesquisas_controller");
			}
		} 
		else 
			redirect("/pesquisas_controller");
	}
	
	function salvar_resultado_pesquisa()
	{
		$name_input = "";
		$id_input = "";
		$erro = 0;
		
		//Caso haja post
		if(isset($_POST) && $_POST)
		{
			//chamo método de validação da pesquisa
			$erro = $this->_validaPesquisa($_POST);
			
			//caso o usuário não tenha respondido todas as perguntas: retorno mensagem de erro!
			if(!$erro)
			{
				$enquete_id = isset($_POST["hdn_enquete-id"]) ? (int)$_POST["hdn_enquete-id"] : 0;
				$usuario_cliente_id = (int)$this->sessao['id_usuario'];
				$data_resposta_usuario = date('Y-m-d H:i:s');
				
				/* Util::debug($_POST);
				die(); */
				foreach($_POST as $key => $value)
				{
					list($name_input,$id_input) = explode("-",$key);									
					
					//verifico cada elemento do $_POST
					switch($name_input)
					{
						case "radio_pergunta_id":
							/* instancio objeto */
							$objResultado = new Resultado_pesquisas_model();
							
							/* seto os valores do objeto */
							$objResultado->set_id_Enquete($enquete_id);
							$objResultado->set_id_Pergunta($id_input);
							$objResultado->set_id_Resposta($value);
							$objResultado->set_id_Usuario($usuario_cliente_id);
							$objResultado->set_DataResposta($data_resposta_usuario);												
							$objResultado->save();
						break;
						
						case "checkbox_pergunta_id":														
							/* laço para salvar as respostas do tipo múltipla escolha */
							foreach($value as $v)
							{
								/* instancio objeto */
								$objResultado = new Resultado_pesquisas_model();
								
								/* seto os valores do objeto */
								$objResultado->set_id_Enquete($enquete_id);
								$objResultado->set_id_Pergunta($id_input);
								$objResultado->set_id_Resposta($v);
								$objResultado->set_id_Usuario($usuario_cliente_id);
								$objResultado->set_DataResposta($data_resposta_usuario);
								$objResultado->save();
							}
						break;
					}
				}
				/* retorno mensagem de sucesso para o template */
				echo "Sucesso";
				
			} else {
				/* retorno mensagem de erro para o template */
				echo "Erro";
			}
		}
	}
	
	private function _validaPesquisa($post)
	{
		$lista_ids_perguntas = array();
		$lista_ids_perguntas_respostas = array();
		$name_input = "";
		$id_input = "";
		$erro = 0;
		
		foreach($post as $key => $value)
		{
			list($name_input,$id_input) = explode("-",$key);
		
			//verifico cada elemento do $_POST
			switch($name_input)
			{
				case "hdn_pergunta_id":
						//adiciono o id da pergunta na lista
						$lista_ids_perguntas[] = $value;		
					break;
				case "radio_pergunta_id":
						//adiciono o id da pergunta que a resposta pertence na lista
						$lista_ids_perguntas_respostas[] = $id_input;		
					break;
				case "checkbox_pergunta_id":
						//adiciono o id da pergunta que a resposta pertence na lista
						$lista_ids_perguntas_respostas[] = $id_input;		
					break;
			}
		}
		
		//realiza validação de preenchimento das respostas
		foreach($lista_ids_perguntas as $id_pergunta)
		{
			if(!in_array($id_pergunta, $lista_ids_perguntas_respostas))
				$erro++;
		}
		
		return $erro;
	}
}
?>