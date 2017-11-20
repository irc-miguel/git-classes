<?php
class View {
	
	public static function montaTemplate($tpl)
	{
		/*
		 * Pega todo o conteudo do $this e joga no objeto
		 */
		$obj =& get_instance();

		//Instancia o template
		$obj->template = new Template();

		$array = array();
		foreach($obj as $key=>$value){
			$type = gettype($value);
			$allowed = array("string","integer","array", "object");
			if(in_array($type,$allowed)){
				$obj->template->assign($key, $value);
			}
		}

		$obj->template->display($tpl);
	  
	}
    
}
?>