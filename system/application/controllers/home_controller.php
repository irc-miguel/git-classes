<?php
class Home_controller extends Controller {

	function Home_controller() {
		parent::Controller();
		//carrego as models
		$this->load->model("Usuario_model");
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
		//instancio o objeto model
		$usuario_model = new Usuario_model();
		$usuario = $usuario_model->buscaUsuarioPorId($this->sessao['id_usuario']);
				
		$this->usuario_nome = $usuario->nome;
		$this->titulo = 'Home - Sistema Web de Pesquisa de Opinião para Produtos e Serviços';	
		$this->aba = 'home';
		View::montaTemplate("home.tpl");
	}
	
}
?>