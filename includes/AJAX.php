<?php
	/**
	 * Víncula las peticiones AJAX con el correspondiente método.
	 * Siempre devuelve una cadena con formato JSON
	 * 
	 * @author		Héctor Laura
	 */

	$rutaReal = dirname(__FILE__);
	$dir = str_replace('\\', '/', $rutaReal);
	$dir = str_replace('/includes', '', $dir);

	require('configs/config.inc.php');
	require(DIR_SMARTY . 'Smarty.class.php');
	require('core.inc.php');
	
	//$action = $_REQUEST['action'];

	$resp = $p->get_AJAX_request($_REQUEST);

	echo json_encode($resp);

	//echo json_encode(call_user_func(array(&$proyecto, $_REQUEST['metodo']), extract($_REQUEST, EXTR_SKIP)));