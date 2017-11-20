<?php
require "smarty/smarty.class.php";

class Template extends Smarty
{
	/**
	 * Construtor
	 * Configurações Smarty Template
	 *
	 */
	public function __construct()
	{
		$this->Smarty();
		$this->template_dir = array('/system/application/views/');
		$this->compile_dir = 'system/application/tmp/';
		$this->cache_dir = 'system/application/tmp/';
		$this->caching = false;
		$this->force_compile = true;
		$this->compile_check = true;
		$this->debugging = false;
		$this->cache_expire = -1;

	}
}

?>