<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty plugin
 *
 * Type:     modifier<br>
 * Name:     system_help_html_replace<br>
 * Date:     Feb 26, 2003
 * Purpose:  convert \r\n, \r or \n to <<br>>
 * Input:<br>
 *         - contents = contents to replace
 *         - preceed_test = if true, includes preceeding break tags
 *           in replacement
 * Example:  {$text|system_help_html_replace}
 * @link http://smarty.php.net/manual/en/language.modifier.nl2br.php
 *          system_help_html_replace (Smarty online manual)
 * @version  1.0
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @return string
 */
function smarty_modifier_system_help_html_replace($string)
{
	// substitui os [p]
	$string = str_replace("[p]", "<p>", $string);
	$string = str_replace("[/p]", "</p>", $string);

	// substitui os [b]
	$string = str_replace("[br]", "<br /><br />", $string);

	return $string;
}


?>
