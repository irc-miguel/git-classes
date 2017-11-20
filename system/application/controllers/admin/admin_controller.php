<?php
class Admin_controller extends Controller {

	function Admin_controller() 
	{
		parent::Controller();
		//carrego as models
		$this->load->model("Usuario_model");
		$this->load->model("Estados_model");
		$this->load->model("Cidades_model");	
		$this->load->model("Escolaridade_model");
	}

	function index() {
		//condição para redirecionar o usuário caso ele já esteja logado
		if ($this->session->userdata('admin') == true)
			redirect("/admin/admin_controller/inicial");
		
		$this->titulo = 'Admin Login - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
		$this->aba = 'inicial';
		$this->action = '/admin/admin_controller/entrar';
		View::montaTemplate("admin/admin_login.tpl");
	}
	
	public function entrar()
	{
		//recebe os dados do form frm_login
		$email = isset($_POST['login']) ? $_POST['login'] : null;
		$senha = isset($_POST['senha']) ? $_POST['senha'] : null;				
		
		//verifica se não houve erro
		if($email != NULL && $senha != NULL) {
			//instancio o objeto model
			$admin_model = new Usuario_model();
			$admin = $admin_model->buscaAdminPorEmail($email);
			
			//valida se o email existe na base de dados e se tem perfil de admin
			if(!empty($admin)) {
				
				//faço a desencriptação para comparação das senhas
				$senha_descriptografada = $this->encrypt->decode($admin->senha);
				
				//valida senha		
				if($senha == $senha_descriptografada) {					
					//inicio a session
					$this->_montarSessao($admin);
					echo "Sucesso";
				} else {
					echo "Erro-senha";
				}
			} else {
				echo "Erro-email";
			}
		}
	}
	
	private function _montarSessao($obj_usuario){
		$dados_sessao = array(
			'id_usuario' => $obj_usuario->id_usuario,				
			'usuario' => $obj_usuario->nome,
			'admin' => $obj_usuario->admin,					
			'logado' => true
		);
		$this->session->set_userdata($dados_sessao);
	}
	
	private function _verificarSessao()
	{
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
	}
	
	public function logout()
	{
		$dados_sessao = array(
			'id_usuario' => '',				
			'usuario' => '',
			'admin'	=> '',							
			'logado' => ''
		);
		//limpo os dados da sessão
		$this->session->unset_userdata($dados_sessao);
		redirect('/admin');
	}
	
	public function esqueciSenha()
	{
		$this->titulo = 'Admin Esqueci minha senha - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
		$this->action = '/admin/admin_controller/enviarSenha';
		View::montaTemplate("admin/admin_esqueci_senha.tpl");
	}
	
	public function enviarSenha()
	{
		$email = isset($_POST["email"]) ? $_POST["email"] : NULL;
		
		if($email){
			$admin_model = new Usuario_model();
			$result = $admin_model->buscaAdminPorEmail($email);						
			
			//caso email esteja cadastrado
			if($result != false){
				
				//faço a desencriptação para enviar a senha
				$senha_descriptografada = $this->encrypt->decode($result->senha);
				
				//monto msg do email
				$msg = "<h3>Olá " . $result->nome . ",</h3>";
				$msg.= "<p>Atendendo a seu pedido, estamos lhe enviando sua senha de a acesso ao " . $this->config->item('site_name') . "</p>";
				$msg.= "<p>Para acessar, clique no link abaixo e informe a sua senha: <strong>" . $senha_descriptografada . "</strong></p>";
				$msg.= "<p>" . anchor('admin') . "</p>";
				$msg.= "<p>Atenciosamente,<br/>" . $this->config->item('site_name') . "</p>";
				
				send_mail($email, "Senha de acesso", $msg);
				echo "Sucesso";
			} else {
				echo "Erro";
			}			
		}
	}
	
	public function inicial()
	{						
		/* abre - validação e carregamento da sessão */
		$this->_verificarSessao();
		/* fecha - validação e carregamento da sessão */
		
		//instancio o objeto model
		$usuario_model = new Usuario_model();
		$usuario = $usuario_model->buscaUsuarioPorId($this->sessao['id_usuario']);
		
		$this->admin_id = $this->sessao['id_usuario'];
		$this->usuario_nome = $usuario->nome;		
		$this->titulo = 'Admin - SPO';
		$this->aba = 'inicial';
		View::montaTemplate("admin/admin_pagina_inicial.tpl");				
	}
	
	public function editarDadosAdmin($id)
	{
		/* abre - validação e carregamento da sessão */
		$this->_verificarSessao();
		/* fecha - validação e carregamento da sessão */
		
		/* abre - carregamento dos dados do admin */
			$usuario_model = new Usuario_model();
			$this->admin = $usuario_model->buscaUsuarioPorId($id);
			$this->admin->data_nascimento = Util::formataDataExibicao($this->admin->data_nascimento);
			
			//faço a desencriptação para carregamento das senhas no formulário
			$this->admin->senha = $this->encrypt->decode($this->admin->senha);
			
			//instancio o modelo Estados_model e invoco o método para listar todos os estados
			$estados_model = new Estados_model();		
			$this->listaEstados = $estados_model->getListaEstados();
			
			$cidades_model = new Cidades_model();
			$cidade = $cidades_model->getCidadePorId($this->admin->cod_cidade);	
				
			$this->estado_admin = $estados_model->getEstadoPorId($cidade->fk_id_estado);
			$this->listaCidades = $cidades_model->getListaCidadesPorIdEstado($cidade->fk_id_estado);
			
			//lista todos os níveis de escolaridade
			$escolaridade_model = new Escolaridade_model();
			$this->listaEscolaridade = $escolaridade_model->getListaEscolaridade();
		/* fecha - carregamento dos dados do admin */
		
		$this->admin_id = $this->sessao['id_usuario'];
		$this->titulo = 'Editar meus dados - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
		$this->aba = 'inicial';
		$this->action = '/admin/admin_controller/atualizarDados';
		View::montaTemplate("admin/edicao_dados_admin.tpl");
	}
	
	public function atualizarDados()
	{
		/* instancio o objeto da classe usuario */
		$usuario_model = new Usuario_model();
	
		/* seto os valores do objeto */
		$usuario_model->setIdUsuario($_POST["hdn_id_admin"]);
		$usuario_model->setNome($_POST["nome"]);
		$usuario_model->setEmail($_POST["email"]);
		$usuario_model->setCidade($_POST["cidade"]);
		$usuario_model->setCep($_POST["cep"]);
		$usuario_model->setSexo($_POST["sexo"]);
		$usuario_model->setDataNascimento($_POST["data_nasc"]);
		$usuario_model->setEscolaridade($_POST["escolaridade"]);
		$usuario_model->setSenha($_POST["conf_senha"]);
		/* salvo os dados do usuario */
		$usuario_model->update();
	
		/* retorno mensagem de sucesso para o template */
		echo "Sucesso";
	}
}
?>