<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter String Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/string_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Code
 *
 * Returns a 4 character numeric code
 *
 * 1
 *
 * becomes:
 *
 * 0001
 *
 * @access	public
 * @param	string
 * @return	string
 */

if (! function_exists('parseSmarty'))
{
	function parseSmarty($tpl)
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

if (! function_exists('postMe'))
{
	function postMe($obj,$escape=true)
	{
		foreach($_POST as $key=>$value){
			$obj->$key = ($escape) ? $obj->db->escape($value) : $value;
		}
	}
}
if (! function_exists('postObjectMe'))
{
	function postObjectMe()
	{
		$obj=array();
		foreach($_POST as $key=>$value){
			$obj[$key] = $value;
		}
		return $obj;
	}
}

if (! function_exists('outputMe'))
{
	function outputMe($obj)
	{
		$data = array();
		foreach($obj as $key=>$value){
			$type = gettype($value);
			$allowed = array("string","integer","array");
			if(in_array($type,$allowed)){
				$data[$key] = $value;
			}
		}
		return $data;
	}
}
if (! function_exists('jsonMe'))
{
	function jsonMe($obj)
	{
		$data['json']=jsonObject($obj);

		return $data;
	}
}
if (! function_exists('jsonObject'))
{
	function jsonObject($obj)
	{
		$json="{";
		$data = array();
		foreach($obj as $key=>$value){
			$type = gettype($value);
			$allowed = array("string","integer");
			if(in_array($type,$allowed)){
				$json.=$key.":'".$value."',";
			}
		}
		$json.="}";
		$json=str_replace(",}","}",$json);
		return $json;
	}
}
if (! function_exists('jsonAgroup'))
{
	function jsonAgroup($obj)
	{
		$jsonReturn="[".$obj."]";
		$jsonReturn=str_replace("},]","}]",$jsonReturn);
		return $jsonReturn;
	}
}
if (! function_exists('queryMe'))
{
	function queryMe($obj,$result)
	{
		foreach($result as $key=>$value){
			$value = (is_null($value)) ? "" : $value;
			$obj->$key = $value;
		}
	}
}
if (! function_exists('sessionMe'))
{
	function sessionMe($obj,$result)
	{
		foreach($result as $key=>$value){
			$obj->session->set_userdata($key,$value);
		}
	}
}
if (! function_exists('prepareObjectToQuery'))
{
	function prepareObjectToQuery($obj) {
		$properties = get_object_vars($obj);
		foreach($properties as $key=>$value){
			if(!in_array($key,$obj->properties)){
				if(gettype($value)=='string' || gettype($value)=='boolean' || gettype($value)=='integer' || gettype($value)=='double'){
					unset($obj->$key);
				}
			} else {
				if (!isset($obj->$key)){
					unset($obj->$key);
				}
			}
		}
	}
}
if (! function_exists('constructMe'))
{
	function constructMe($obj) {
		$obj->properties = array_keys(get_object_vars($obj));
	}
}
if (! function_exists('importMe'))
{
	function importMe($objFrom, $objTo, $utf8_decode=false) {
		foreach($objFrom as $property=>$value){
			if(gettype($value)=='string'){
				$objTo->$property	= ($utf8_decode) ? utf8_decode($value) : $value;
			} else {
				$objTo->$property	= $value;
			}
		}
	}
}
if (! function_exists('parseMe')){
	function parseMe($view,$obj=false,$utf8=false){
		global $BM;
		if(!$obj){
			$CI =& get_instance();
		} else {
			$CI = $obj;
		}

		$CI->elapsed_time = $BM->elapsed_time('total_execution_time_start', 'total_execution_time_end');
		$CI->memory_usage = ( ! function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2).'MB';

		$return = $CI->parser->parse($view, outputMe($CI),true);
		echo ($utf8) ? utf8_encode($return) : $return;
	}
}
?>