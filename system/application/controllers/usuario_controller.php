<?php
class Usuario_controller extends Controller {

	function __construct()
    {
        parent::Controller();
        //carrego as models
        $this->load->model("Usuario_model");
		$this->load->model("Estados_model");
		$this->load->model("Cidades_model");
		$this->load->model("Escolaridade_model");
    }
	
	public function login() 
	{
		//condição para redirecionar o usuário caso ele já esteja logado
		if ($this->session->userdata('logado') == true && $this->session->userdata('admin') == false)
			redirect("home_controller");
			
		$this->titulo = 'Login - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
		$this->action = '/usuario_controller/entrar';
		
		View::montaTemplate("login.tpl");
	}
	
	public function entrar()
	{
		//recebe os dados do form frm_login
		$email = isset($_POST['login']) ? $_POST['login'] : null;
		$senha = isset($_POST['senha']) ? $_POST['senha'] : null;				

		//verifica email e senha
		if($email != NULL && $senha != NULL) 
		{
			//instancio o objeto model
			$usuario_model = new Usuario_model();
			$usuario = $usuario_model->buscaUsuarioPorEmail($email);

			//valida se o email do usuário existe na base de dados
			if(!empty($usuario)) {
				
				//faço a desencriptação para comparação das senhas
				$senha_descriptografada = $this->encrypt->decode($usuario->senha);

				//valida senha		
				if($senha == $senha_descriptografada) {					
					if(!$usuario->admin){
						//inicio a session
						$this->_montarSessao($usuario);
						echo "Sucesso";
					} else {
						echo "Erro-usuario";
					}					
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
	
	public function cadastro()
	{
		//instancio o modelo Estados_model e invoco o método para listar todos os estados
		$estados_model = new Estados_model();		
		$this->listaEstados = $estados_model->getListaEstados();
				
		//lista todos os níveis de escolaridade
		$escolaridade_model = new Escolaridade_model();
		$this->listaEscolaridade = $escolaridade_model->getListaEscolaridade();	
		
		$this->titulo = 'Cadastro - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
		$this->action = '/usuario_controller/salvarCadastro';
		View::montaTemplate("cadastro.tpl");
	}
	
	public function salvarCadastro()
	{			
		/* instancio o objeto da classe usuario */
		$usuario_model = new Usuario_model();
		
		//verifico se email ja esta cadastrado na base de dados
		$result_email = $usuario_model->buscaUsuarioPorEmail($_POST["email"]);

		//caso email não esteja cadastrado
		if(!$result_email){
											
			/* seto os valores do objeto */
			$usuario_model->setNome($_POST["nome"]);
			$usuario_model->setEmail($_POST["email"]);
			$usuario_model->setCidade($_POST["cidade"]);
			$usuario_model->setCep($_POST["cep"]);
			$usuario_model->setSexo($_POST["sexo"]);
			$usuario_model->setDataNascimento($_POST["data_nasc"]);
			$usuario_model->setEscolaridade($_POST["escolaridade"]);
			$usuario_model->setSenha($_POST["conf_senha"]);
			/* salvo os dados do usuario */
			$usuario_model->save();
			
			//monto msg do email
			$msg = "<h3>Olá " . $_POST["nome"] . ",</h3>";
			$msg.= "<p>Obrigado por se cadastrar no " . $this->config->item('site_name') . "</p>";
			$msg.= "<p>Seguem seus dados de acesso: </p>";
			$msg.= "<p>Login: <strong>" . $_POST["email"] . "</strong></p>";
			$msg.= "<p>Senha: <strong>" . $_POST["conf_senha"] . "</strong></p>";
			$msg.= "<p>Para acessar agora, clique no link abaixo e informe seus dados:</p>";
			$msg.= "<p>" . anchor('usuario_controller/login') . "</p>";
			$msg.= "<p>Atenciosamente,<br/>" . $this->config->item('site_name') . "</p>";
			
			send_mail($_POST["email"], "Confirmação de Cadastro", $msg);
			echo "Sucesso";
		} else {
			echo "Erro";
		}
	}
	
	public function atualizarcidades()
	{	
		if($_POST)
		{
			$this->load->model("Cidades_model");
			$objCidades = new Cidades_model();
			$listaCidades = $objCidades->getListaCidadesPorIdEstado($_POST["id"]);
			if($listaCidades)
			{
				$retorno = '<option value="">Selecione</option>';
				foreach($listaCidades as $cidade)
					$retorno .= '<option value="'.$cidade->id.'">'.$cidade->nome.'</option>';
			}
			else
				$retorno = '<option value="">Nenhuma cidade cadastrada para o estado selecionado.</option>';		
			die($retorno);
		}
	}
	
	public function esqueciSenha()
	{	
		$this->titulo = 'Esqueci minha senha - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
		$this->action = '/usuario_controller/enviarSenha';
		View::montaTemplate("esqueci_senha.tpl");	
	}
	
	public function enviarSenha()
	{
		$email = isset($_POST["email"]) ? $_POST["email"] : NULL;
		
		if($email){
			$usuario_model = new Usuario_model();
			$result = $usuario_model->buscaUsuarioPorEmail($email);
			
			//caso email esteja cadastrado
			if($result != false){
				
				//faço a desencriptação para enviar a senha
				$senha_descriptografada = $this->encrypt->decode($result->senha);
				
				//monto msg do email
				$msg = "<h3>Olá " . $result->nome . ",</h3>";
				$msg.= "<p>Atendendo a seu pedido, estamos lhe enviando sua senha de a acesso ao " . $this->config->item('site_name') . "</p>";
				$msg.= "<p>Para acessar, clique no link abaixo e informe a sua senha: <strong>" . $senha_descriptografada . "</strong></p>";
				$msg.= "<p>" . anchor('usuario_controller/login') . "</p>";
				$msg.= "<p>Atenciosamente,<br/>" . $this->config->item('site_name') . "</p>";
				
				send_mail($email, "Senha de acesso", $msg);
				echo "Sucesso";				
			} else {
				echo "Erro";	
			}			
		}
	}
	
	public function editarDadosUsuario($id_usuario)
	{	
		/* abre - validação e carregamento da sessão */
		$this->sessao = $this->session->userdata;		
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
		/* fecha - validação e carregamento da sessão */			
		
		/* abre - carregamento dos dados do usuário */
			$usuario_model = new Usuario_model();
			$this->usuario = $usuario_model->buscaUsuarioPorId($id_usuario);
			$this->usuario->data_nascimento = Util::formataDataExibicao($this->usuario->data_nascimento);
			
			//faço a desencriptação para carregamento das senhas no formulário
			$this->usuario->senha = $this->encrypt->decode($this->usuario->senha);
			
			//instancio o modelo Estados_model e invoco o método para listar todos os estados
			$estados_model = new Estados_model();		
			$this->listaEstados = $estados_model->getListaEstados();
			
			$cidades_model = new Cidades_model();
			$cidade = $cidades_model->getCidadePorId($this->usuario->cod_cidade);	
				
			$this->estado_usuario = $estados_model->getEstadoPorId($cidade->fk_id_estado);
			$this->listaCidades = $cidades_model->getListaCidadesPorIdEstado($cidade->fk_id_estado);
			
			//lista todos os níveis de escolaridade
			$escolaridade_model = new Escolaridade_model();
			$this->listaEscolaridade = $escolaridade_model->getListaEscolaridade();
		/* fecha - carregamento dos dados do usuário */
		
		$this->usuario_id = $this->sessao['id_usuario'];
		$this->titulo = 'Editar meus dados - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';
		$this->action = '/usuario_controller/atualizarDados';
		View::montaTemplate("edicao_dados_usuario.tpl");
	}
	
	public function atualizarDados()
	{
		/* instancio o objeto da classe usuario */
		$usuario_model = new Usuario_model();
		
		/* seto os valores do objeto */		
		$usuario_model->setIdUsuario($_POST["hdn_id_usuario"]);
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
		redirect('/usuario_controller/login');
	}
}
?>