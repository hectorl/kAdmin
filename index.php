<?php
	/**
	 * @author		Héctor Laura
	 * 
	 */
	error_reporting(E_ALL);
	//error_reporting(E_ALL & ~E_NOTICE);

	header('Content-type: text/html; charset=utf-8');
	//sacamos la ruta real
	$rutaReal = dirname(__FILE__);
	$dir = str_replace('\\', '/', $rutaReal);

	require($dir . '/includes/configs/config.inc.php');
	require(DIR_INC . 'core.inc.php');

	//sacamos la página que queremos cargar
	$tpl = $p->get_pagina(POS_PAG);

	$p->smarty->debugging = 0;
	$p->smarty->caching = false;

	$tpl_file = 'file:' . DIR_PLUG . $p->plugin . '/tpl/' . $tpl['inc'];

	$p->smarty->assign('tpl', (($p->smarty->templateExists($tpl_file)) ? $tpl_file : 'inc.404.tpl'));

	//We check if it has to be included in main or in a independent tpl
	if($tpl['in_main']){

		$p->smarty->display('site.main.tpl');

	}else{

		$p->smarty->display($tpl_file);

	}//fin else
	
	//$p->get_memory();
