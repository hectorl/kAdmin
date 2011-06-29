<?php
/**
 * Smarty plugin
 * 
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {html_select} plugin
 * 
 * Type:     function<br>
 * Name:     html_select<br>
 * Purpose:  Prints the dropdowns for data selection.
 * 
 * 
 * @link 
 * @version 1.0
 * @author 	Héctor Laura 
 * @param array $params parameters
 * @param object $smarty Smarty object
 * @param object $template template object
 * @return string 
 */
function smarty_function_html_select($params, $smarty, $template){
	require_once(SMARTY_PLUGINS_DIR . 'shared.escape_special_chars.php');
	require_once(SMARTY_PLUGINS_DIR . 'shared.make_timestamp.php');
	require_once(SMARTY_PLUGINS_DIR . 'function.html_options.php');

	$select = '<select';

	foreach($params as $_key => $_val) {
		switch($_key){
			case 'id':
				$select .= ' id="' . $_val . '"';
				break;
			case 'name':
				$select .= ' name="' . $_val . '"';
				break;
			case 'class':
				$select .= ' class="' . $_val . '"';
				break;
			case 'selected':
				$selected = $_val;
				break;
			case 'from':
				$from = $_val;
	 	}//fin switch
	 }//fin foreach

	$select .= '>';
	
	foreach($from as $elem){
		$options .= '<option value="' . $elem['value'] . '"';
		
		if($selected == $elem['value']){
			$options .= 'selected="selected"';	
		}//fin if
		
		$options .= '>' . $elem['text'] . '</option>';		
	}//fin foreach

	return $select . $options . '</select>';
}//fin smarty_function_html_select