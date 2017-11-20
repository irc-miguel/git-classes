<?php
class Admin_pesquisa_controller extends Controller {
	
	function Admin_pesquisa_controller() {
		parent::Controller();
		//carrego as models
		$this->load->model("Usuario_model");
		$this->load->model("Enquetes_model");
		$this->load->model("Perguntas_model");
		$this->load->model("Respostas_model");
		$this->load->model("Tipo_perguntas_model");
		$this->load->model("Resultado_pesquisas_model");
		
		//carrego a sessão
		$this->sessao = $this->session->userdata;
		
		//verifica se o usuário está logado
		if (!isset($this->sessao['logado'])) {
			$obj =& get_instance();
			$obj->session->set_userdata('_url_', $_SERVER['REQUEST_URI']);
			redirect('/admin');
		} else {
			// verifico se usuario possui perfil de admin
			if($this->sessao['admin'] != true){
				redirect('/admin');
			}
		}
		
		//carrega id do admin no menu lateral
		$this->admin_id = $this->sessao['id_usuario'];
	}
	
	function listar_pesquisas()
	{	
		$enquetes_model = new Enquetes_model();
		$this->enquetes = $enquetes_model->getEnquetes();
		
		$this->titulo = 'Pesquisas - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
		$this->aba = 'pesquisa';
		View::montaTemplate("admin/admin_pesquisas.tpl");
	}

	function cadastrar_enquete() 
	{		
		$this->titulo = 'Cadastrar Pesquisa - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
		$this->aba = 'pesquisa';
		$this->action = '/admin/admin_pesquisa_controller/salvar_enquete';
		$this->titulo_enq = "";
		$this->descricao_enq = "";
		View::montaTemplate("admin/admin_cadastro_enquete.tpl");
	}
	
	function salvar_enquete()
	{	
		$titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : NULL;
		$descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : NULL;
		$data_cadastro = date('Y-m-d');
		$id_autor = (int)$this->session->userdata('id_usuario');
		
		$enquetes_model = new Enquetes_model();		
		//verifica se possui titulo cadastrado
		$result = $enquetes_model->getEnquetePorTitulo($titulo);
		
		//caso título não esteja cadastrado
		if(!$result){		
			/* seto os valores do objeto */
			$enquetes_model->setTitulo($titulo);
			$enquetes_model->setDescricao($descricao);
			$enquetes_model->setData($data_cadastro);
			$enquetes_model->setAutor($id_autor);
			$enquetes_model->save();
			/* retorno mensagem de sucesso para o template */
			echo "Sucesso";
		} else {
			/* retorno mensagem de erro para o template */
			echo "Erro";
		}
	}
	
	function editar_enquete($id_enquete) 
	{	
		if($id_enquete){
			
			$enquetes_model = new Enquetes_model();
			$enquete = $enquetes_model->getEnquetePorID($id_enquete);
			
			//caso possua enquete
			if($enquete){
				$this->titulo = 'Editar Pesquisa - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
				$this->aba = 'pesquisa';
				$this->action = '/admin/admin_pesquisa_controller/atualizar_enquete';
				$this->enquete = $enquete;
				View::montaTemplate("admin/admin_editar_enquete.tpl");
			}
			//senão redireciono para listagem de pesquisas
			else
				redirect("/admin/admin_pesquisa_controller/listar_pesquisas");
			
		} else 
			redirect("/admin/admin_pesquisa_controller/listar_pesquisas");
	}
	
	function atualizar_enquete() 
	{	
		$id 			= isset($_POST["enquete_id"]) ? $_POST["enquete_id"] : NULL;
		$enquete_titulo = isset($_POST["enquete_titulo"]) ? $_POST["enquete_titulo"] : NULL;
		$titulo 		= isset($_POST["titulo"]) ? $_POST["titulo"] : NULL;
		$descricao 		= isset($_POST["descricao"]) ? $_POST["descricao"] : NULL;
		$result = false;
		
		if($id){
			$enquetes_model = new Enquetes_model();			
			//verifica se possui título cadastrado
			if($enquete_titulo != $titulo)
				$result = $enquetes_model->getEnquetePorTitulo($titulo);
			
			if(!$result)
			{
				/* seto os valores do objeto */
				$enquetes_model->setTitulo($titulo);
				$enquetes_model->setDescricao($descricao);
				$enquetes_model->update($id);
				/* retorno mensagem de sucesso para o template */
				echo "Sucesso";
			}
			else 
			{
				/* retorno mensagem de erro para o template */
				echo "Erro";
			}
		}
	}
	
	function verifica_enquete($id) 
	{		
		$perguntas_model = new Perguntas_model();		
		$perguntas = $perguntas_model->getPerguntasPorEnquete($id);
		$possui_perguntas = false;
		$possui_respostas = false;
		
		// caso enquete possua perguntas cadastradas
		if($perguntas){
					
			$possui_perguntas = true;
			$respostas_model = new Respostas_model();			
			
			foreach($perguntas as $pergunta){
				$result = $respostas_model->getRespostasPorPergunta($pergunta->id);	
				if($result)
					$possui_respostas = true;
			}				
		}
		
		//envio resposta para a requisição
		if(!$possui_perguntas){
			echo('vazia');
		}
		elseif($possui_perguntas == true && $possui_respostas == false){
			echo('possui_perguntas');
		} 
		elseif($possui_perguntas == true && $possui_respostas == true){	
			echo('possui_respostas');
		}		
	}
	
	function excluir_enquete($id)
	{			
		$perguntas_model = new Perguntas_model();
		$respostas_model = new Respostas_model();
		$perguntas = $perguntas_model->getPerguntasPorEnquete($id);
		
		// caso enquete possua perguntas cadastradas
		if($perguntas){			
			foreach($perguntas as $pergunta){
				$result = $respostas_model->getRespostasPorPergunta($pergunta->id);
				// caso pergunta possua respostas, as respotas são excluídas
				if($result)
					$respostas_model->excluirRespostasPorPergunta($pergunta->id);
			}			
			// as perguntas relacionadas a enquete são excluídas
			$perguntas_model->excluirPerguntasPorEnquete($id);
		}
		
		// exclui os resultados referente a pesquisa que está sendo excluída
		$resultado_model = new Resultado_pesquisas_model();
		$resultado_model->delete($id);
		
		// exclui a enquete
		$enquetes_model = new Enquetes_model();
		$enquetes_model->delete($id);
		
		//confirma a exclusão
		die('ok');
	}
	
	function visualizar_pesquisa($id)
	{
		if($id){
			
			$enquetes_model = new Enquetes_model();
			$enquete = $enquetes_model->getEnquetePorID($id);
			$perguntas = false;
			
			//caso possuir enquete
			if($enquete){
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

				$this->titulo = 'Visualizar Pesquisa - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
				$this->aba = 'pesquisa';
				$this->enquete = $enquete;
				$this->perguntas = $perguntas;
				View::montaTemplate("admin/admin_visualizar_pesquisa.tpl");
			}
			//senão redireciono para listagem de pesquisas 
			else {
				redirect("/admin/admin_pesquisa_controller/listar_pesquisas");
			}			
		} else 
			redirect("/admin/admin_pesquisa_controller/listar_pesquisas");
	}
	
	function cadastrar_pergunta($id_enquete)
	{		
		$enquetes_model = new Enquetes_model();
		$enquete = $enquetes_model->getEnquetePorID($id_enquete);
		
		if($enquete)
		{
			// instancio o modelo Tipo_perguntas_model e invoco o método para listar todos os tipos
			$tipo_perguntas_model = new Tipo_perguntas_model();
			$this->listaTipos = $tipo_perguntas_model->getTipoPerguntas();
			
			$this->titulo = 'Cadastrar Pergunta - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
			$this->aba = 'pesquisa';
			$this->enquete = $enquete;
			$this->action = '/admin/admin_pesquisa_controller/salvar_pergunta';
			View::montaTemplate("admin/admin_cadastro_pergunta.tpl");		
		}
		else
			redirect("/admin/admin_pesquisa_controller/listar_pesquisas");
	}
		
	function salvar_pergunta()
	{		
		$pergunta = isset($_POST["pergunta"]) ? $_POST["pergunta"] : NULL;
		$tipo_pergunta = isset($_POST["tipo_pergunta"]) ? $_POST["tipo_pergunta"] : NULL;
		$id_enquete = isset($_POST["id_enquete"]) ? (int)$_POST["id_enquete"] : NULL;
		
		$pergunta_model = new Perguntas_model();
		//verifica se possui pergunta cadastrada
		$result = $pergunta_model->getVerificaPergunta($pergunta, $id_enquete);
		
		//caso pergunta não esteja cadastrada
		if(!$result){
			/* seto os valores do objeto pergunta */
			$pergunta_model->set_id_Enquete($id_enquete);
			$pergunta_model->set_Pergunta($pergunta);
			$pergunta_model->set_Tipo_Pergunta($tipo_pergunta);
			$pergunta_model->save();			
		  	/* retorno mensagem de sucesso para o template */
		  	echo "Sucesso";
		} else {
			/* retorno mensagem de erro para o template */
			echo "Erro";
		}
	}
	
	function editar_pergunta($id_pergunta)
	{					
		if($id_pergunta){
			
			$pergunta_model = new Perguntas_model();
			$pergunta = $pergunta_model->getPerguntaPorID($id_pergunta);
			
			//caso possua pergunta
			if($pergunta){
				$enquetes_model = new Enquetes_model();
				$enquete = $enquetes_model->getEnquetePorID($pergunta->id_enquete);
				
				// instancio o modelo Tipo_perguntas_model e invoco o método para listar todos os tipos
				$tipo_perguntas_model = new Tipo_perguntas_model();
				$this->listaTipos = $tipo_perguntas_model->getTipoPerguntas();
				
				$this->titulo = 'Editar Pergunta - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
				$this->aba = 'pesquisa';
				$this->pergunta = $pergunta;
				$this->enquete = $enquete;		 
				$this->action = '/admin/admin_pesquisa_controller/atualizar_pergunta';
				View::montaTemplate("admin/admin_editar_pergunta.tpl");
			}
			//senão redireciono para listagem de pesquisas
			else
				redirect("/admin/admin_pesquisa_controller/listar_pesquisas");
			
		} else 
			redirect("/admin/admin_pesquisa_controller/listar_pesquisas");
	}
	
	function atualizar_pergunta()
	{	
		$pergunta 	   	 = isset($_POST["pergunta"]) ? $_POST["pergunta"] : NULL;
		$tipo_pergunta 	 = isset($_POST["tipo_pergunta"]) ? $_POST["tipo_pergunta"] : NULL;
		$id_pergunta   	 = isset($_POST["id_pergunta"]) ? (int)$_POST["id_pergunta"] : NULL;
		$pergunta_titulo = isset($_POST["pergunta_titulo"]) ? $_POST["pergunta_titulo"] : NULL;
		$id_enquete 	 = isset($_POST["id_enquete"]) ? (int)$_POST["id_enquete"] : NULL;
		$result = false;
		
		if($id_pergunta){
			$pergunta_model = new Perguntas_model();
			//verifica se possui pergunta cadastrada
			if($pergunta_titulo != $pergunta)
				$result = $pergunta_model->getVerificaPergunta($pergunta, $id_enquete);
			
			if(!$result)
			{
				/* seto os valores do objeto */
				$pergunta_model->set_Pergunta($pergunta);
				$pergunta_model->set_Tipo_Pergunta($tipo_pergunta);				
				$pergunta_model->update($id_pergunta);
				/* retorno mensagem de sucesso para o template */
				echo "Sucesso";
			}
			else
			{
				/* retorno mensagem de erro para o template */
				echo "Erro";
			}
		}
	}
	
	function verifica_pergunta($id_pergunta)
	{		
		$respostas_model = new Respostas_model();		
		$possui_respostas = $respostas_model->getRespostasPorPergunta($id_pergunta);	
		
		//envio resposta para a requisição
		if(!$possui_respostas)
			die('vazia');
		else
			die('possui_respostas');
	}
	
	function excluir_pergunta($id)
	{		
		$respostas_model = new Respostas_model();
		$respostas = $respostas_model->getRespostasPorPergunta($id);
		// caso pergunta possua respostas, as respotas são excluídas
		if($respostas)
			$respostas_model->excluirRespostasPorPergunta($id);
			
		$perguntas_model = new Perguntas_model();
		$perguntas_model->delete($id);
		//confirma a exclusão
		die('ok');		
	}
	
	function visualizar_pergunta($id_pergunta)
	{
		if($id_pergunta){
			
			$perguntas_model = new Perguntas_model();
			$pergunta = $perguntas_model->getPerguntaPorID($id_pergunta);
			$respostas = false;
			
			//caso possua pergunta
			if($pergunta){				
				//busco os dados da enquete
				$enquetes_model = new Enquetes_model();
				$enquete = $enquetes_model->getEnquetePorID($pergunta->id_enquete);
				
				//busco o nome do tipo da pergunta
				$tipo_perguntas_model = new Tipo_perguntas_model();
				$tipo = $tipo_perguntas_model->getTipoPorID($pergunta->tipo);
				
				//verifico se possui respostas
				$respostas_model = new Respostas_model();
				$respostas = $respostas_model->getRespostasPorPergunta($id_pergunta);				

				$this->titulo = 'Visualizar Pergunta - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
				$this->aba = 'pesquisa';
				$this->enquete = $enquete;
				$this->pergunta = $pergunta;
				$this->respostas = $respostas;
				$this->tipo_pergunta = $tipo->tipo;
				View::montaTemplate("admin/admin_visualizar_pergunta.tpl");
			}
			//senão redireciono para listagem de pesquisas
			else {
				redirect("/admin/admin_pesquisa_controller/listar_pesquisas");
			}
		} else
			redirect("/admin/admin_pesquisa_controller/listar_pesquisas");
	}
	
	function cadastrar_resposta($id_pergunta)
	{
		$perguntas_model = new Perguntas_model();
		$pergunta = $perguntas_model->getPerguntaPorID($id_pergunta);
		
		//busco os dados da enquete
		$enquetes_model = new Enquetes_model();
		$enquete = $enquetes_model->getEnquetePorID($pergunta->id_enquete);
		
		if($pergunta)
		{				
			$this->titulo = 'Cadastrar Resposta - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
			$this->aba = 'pesquisa';
			$this->enquete = $enquete;
			$this->pergunta = $pergunta;
			$this->action = '/admin/admin_pesquisa_controller/salvar_resposta';
			View::montaTemplate("admin/admin_cadastro_resposta.tpl");
		}
		else
			redirect("/admin/admin_pesquisa_controller/listar_pesquisas");
	}
	
	function salvar_resposta()
	{
		$resposta = isset($_POST["resposta"]) ? $_POST["resposta"] : NULL;
		$id_pergunta = isset($_POST["id_pergunta"]) ? (int)$_POST["id_pergunta"] : NULL;
		
		$resposta_model = new Respostas_model();
		//verifica se possui resposta cadastrada
		$result = $resposta_model->getVerificaResposta($resposta, $id_pergunta);
		
		//caso resposta não esteja cadastrada para a mesma pergunta
		if(!$result){
			/* seto os valores do objeto pergunta */
			$resposta_model->set_id_Pergunta($id_pergunta);
			$resposta_model->set_Resposta($resposta);
			$resposta_model->save();
			/* retorno mensagem de sucesso para o template */
			echo "Sucesso";
		} else {
			/* retorno mensagem de erro para o template */
			echo "Erro";
		}
	}
	
	function editar_resposta($id_resposta)
	{
		if($id_resposta){
				
			$respostas_model = new Respostas_model();
			$resposta = $respostas_model->getRespostaPorID($id_resposta);
			
			//caso possua resposta
			if($resposta){
				
				//busco os dados da pergunta
				$perguntas_model = new Perguntas_model();
				$pergunta = $perguntas_model->getPerguntaPorID($resposta->fk_id_pergunta);
				
				//busco os dados da enquete
				$enquetes_model = new Enquetes_model();
				$enquete = $enquetes_model->getEnquetePorID($pergunta->id_enquete);				
	
				$this->titulo = 'Editar Resposta - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
				$this->aba = 'pesquisa';	
				$this->enquete = $enquete;
				$this->pergunta = $pergunta;				
				$this->resposta = $resposta;
				$this->action = '/admin/admin_pesquisa_controller/atualizar_resposta';
				View::montaTemplate("admin/admin_editar_resposta.tpl");
			}
			//senão redireciono para listagem de pesquisas
			else
				redirect("/admin/admin_pesquisa_controller/listar_pesquisas");
				
		} else
			redirect("/admin/admin_pesquisa_controller/listar_pesquisas");
	}
	
	function atualizar_resposta()
	{
		$resposta 	   	 = isset($_POST["resposta"]) ? $_POST["resposta"] : NULL;
		$id_resposta   	 = isset($_POST["id_resposta"]) ? (int)$_POST["id_resposta"] : NULL;
		$resposta_titulo = isset($_POST["resposta_titulo"]) ? $_POST["resposta_titulo"] : NULL;
		$id_pergunta 	 = isset($_POST["id_pergunta"]) ? (int)$_POST["id_pergunta"] : NULL;
		$result = false;
		
		if($id_resposta){
			$resposta_model = new Respostas_model();
			//verifica se possui pergunta cadastrada
			if($resposta_titulo != $resposta)
				$result = $resposta_model->getVerificaResposta($resposta, $id_pergunta);
				
			if(!$result)
			{
				/* seto os valores do objeto */
				$resposta_model->set_Resposta($resposta);
				$resposta_model->update($id_resposta);
				/* retorno mensagem de sucesso para o template */
				echo "Sucesso";
			}
			else
			{
				/* retorno mensagem de erro para o template */
				echo "Erro";
			}
		}
	}
	
	function excluir_resposta($id)
	{			
		$resposta_model = new Respostas_model();
		$resposta_model->delete($id);
		//confirma a exclusão
		die('ok');
	}
	
	function relatorios()
	{
		$enquetes_model = new Enquetes_model();
		$this->enquetes = $enquetes_model->getEnquetes();
		
		$this->titulo = 'Relatórios - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
		$this->aba = 'relatorios';
		View::montaTemplate("admin/admin_relatorios.tpl");
	}
	
	function relatorio_pesquisa($id)
	{
		if($id)
		{
			$enquetes_model = new Enquetes_model();
			$enquete = $enquetes_model->getEnquetePorID($id);
			$perguntas = false;
			$total_quantidade_resposta = 0;
				
			//caso possua enquete
			if($enquete)
			{
				//verifico se possui perguntas
				$perguntas_model = new Perguntas_model();
				$perguntas = $perguntas_model->getPerguntasPorEnquete($enquete->id);
			
				//caso possuir perguntas, verifico se possui respostas
				if($perguntas){
					
					$respostas_model = new Respostas_model();
					
					//Perguntas
					foreach($perguntas as $perg){
						
						$respostas = $respostas_model->getRespostasPorPergunta($perg->id);
						$objResultado = new Resultado_pesquisas_model();
						
						//verifica quantidade de cada resposta na tabela de resultados											
						if($respostas)
						{
							//Respostas
							foreach($respostas as $resp)
							{								
								$qtde = $objResultado->getQuantidadeResposta($resp->id);
								$resp->qtde_resposta = $qtde->TOTAL;
																
								//incremento a quantidade total (100%)
								$total_quantidade_resposta += $qtde->TOTAL;
							}
							
							//faço laço novamente para calcular a porcentagem
							foreach($respostas as $resp)
							{
								if($total_quantidade_resposta > 0)
								{								
									/* abre - Regra de porcentagem para as respostas */
									$x = 100 * $resp->qtde_resposta;
									$x = $x / $total_quantidade_resposta;
									$resp->porcentagem = (int)$x;
									/* fecha - Regra de porcentagem para as respostas */
								} else {
									$resp->porcentagem = 0;
								}
							}
						}
						
						$perg->respostas = $respostas;
						$total_quantidade_resposta = 0;
					}
				}
				
				//verifica os dados dos usuários
				$resultado_pesquisas_model = new Resultado_pesquisas_model();
				$estatisticas = $resultado_pesquisas_model->getEstatisticasUsuariosPesquisa($enquete->id);
				
				//contadores usados nas estatísticas
				$qtde_masculino = 0;
				$qtde_feminino = 0;
				$ensino_fundamental_incompleto = 0;
				$ensino_fundamental_completo = 0;
				$ensino_medio_incompleto = 0;
				$ensino_medio_completo = 0;
				$tecnico_posmedio_incompleto = 0;
				$tecnico_posmedio_completo = 0;
				$superior_incompleto = 0;
				$superior_completo = 0;
				$idade_ate_18 = 0;
				$idade_19_25 = 0;
				$idade_26_35 = 0;
				$idade_36_55 = 0;
				$idade_mais_55 = 0;
				
				if($estatisticas)
				{				
					foreach($estatisticas as $estatistica)
					{
						//verifica o sexo dos participantes
						if($estatistica->sexo == "Masculino")
							$qtde_masculino++;
						if($estatistica->sexo == "Feminino")
							$qtde_feminino++;
						
						//verifica a escolaridade dos participantes
						switch($estatistica->nivel_escolaridade) 
						{
							case "Ensino Fundamental Incompleto":
								$ensino_fundamental_incompleto++;
								break;
							case "Ensino Fundamental Completo":
								$ensino_fundamental_completo++;
								break;
							case "Ensino Médio Incompleto":
								$ensino_medio_incompleto++;
								break;
							case "Ensino Médio Completo":
								$ensino_medio_completo++;
								break;
							case "Técnico/Pós-Médio Incompleto":
								$tecnico_posmedio_incompleto++;
								break;
							case "Técnico/Pós-Médio Completo":
								$tecnico_posmedio_completo++;
								break;
							case "Superior Incompleto":
								$superior_incompleto++;
								break;
							case "Superior Completo":
								$superior_completo++;
								break;
						}
						
						//valores para calculo da faixa etária
						$data_nasc = $estatistica->data_nascimento;
						$data_atual = date('Y-m-d');
						
						//pega o timestamp das datas
						$time_nasc = strtotime($data_nasc);
						$time_atual = strtotime($data_atual);
						//calcula diferença entre as datas
						$diferenca = $time_atual - $time_nasc;
						//calculo para descobrir a idade do participante
						$dias = (int)floor( $diferenca / (60 * 60 * 24));
						$anos = (int)($dias/365);						
						$estatistica->anos = $anos;
						
						//verifica a faixa etária dos participantes
						if($estatistica->anos <= 18)
							$idade_ate_18++;
						elseif($estatistica->anos >= 19 && $estatistica->anos <= 25)
							$idade_19_25++;
						elseif($estatistica->anos >= 26 && $estatistica->anos <= 35)
							$idade_26_35++;
						elseif($estatistica->anos >= 35 && $estatistica->anos <= 55)
							$idade_36_55++;
						else
							$idade_mais_55++;						
					}
				}						
				
				$this->titulo = 'Visualizar Relatório - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
				$this->aba = 'relatorios';
				$this->enquete = $enquete;				
				$this->perguntas = $perguntas;
				$this->qtde_participantes = ($estatisticas) ? count($estatisticas) : 0;
				$this->qtde_masculino = $qtde_masculino;
				$this->qtde_feminino = $qtde_feminino;
				$this->ensino_fundamental_incompleto = $ensino_fundamental_incompleto;
				$this->ensino_fundamental_completo = $ensino_fundamental_completo;
				$this->ensino_medio_incompleto = $ensino_medio_incompleto;
				$this->ensino_medio_completo = $ensino_medio_completo;
				$this->tecnico_posmedio_incompleto = $tecnico_posmedio_incompleto;
				$this->tecnico_posmedio_completo = $tecnico_posmedio_completo;
				$this->superior_incompleto = $superior_incompleto;
				$this->superior_completo = $superior_completo;
				$this->idade_ate_18 = $idade_ate_18;
				$this->idade_19_25 = $idade_19_25;
				$this->idade_26_35 = $idade_26_35;
				$this->idade_36_55 = $idade_36_55;
				$this->idade_mais_55 = $idade_mais_55;
				View::montaTemplate("admin/admin_visualizar_relatorio.tpl");
			}
			//senão redireciono para listagem de relatórios
			else {
				redirect("/admin/admin_pesquisa_controller/relatorios");
			}
		}
		else
			redirect("/admin/admin_pesquisa_controller/relatorios");
	}
}
?>