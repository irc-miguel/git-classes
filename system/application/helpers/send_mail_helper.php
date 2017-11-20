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

if (! function_exists('send_mail')){
	function send_mail($to,$subject,$message){
		$CI =& get_instance();
		$smtp=$CI->config->item('email_smtp_host');
		$port=$CI->config->item('email_smtp_port');
		$email=$CI->config->item('email_account');
		$name=$CI->config->item('email_name');
		$password=$CI->config->item('email_password');

		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => $smtp,
		    'smtp_port' => $port,
		    'smtp_user' => $email,
		    'smtp_pass' => $password,
		    'mailtype'  => 'html',
		    'charset'   => 'utf-8'
		    );
		    $CI->load->library('email', $config);
		    $CI->email->set_newline("\r\n");
		    $CI->email->set_mailtype('html');

		    $CI->email->from("$email","$name");
		    $CI->email->to($to);
		    $CI->email->subject($subject);
		    $CI->email->message($message);
		    $CI->email->send();
		    $CI->email->clear();
	}
}
?>