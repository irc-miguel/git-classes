<?php
/**
 * Smarty plugin
 * @package helpers/smarty
 * @subpackage plugins
 */
function smarty_modifier_urlpath($string)
{
	return URLPATH . $string;
}
?>