<?php

	$rutaReal = dirname(__FILE__);
	$dir = str_replace('\\', '/', $rutaReal);
	$dir = str_replace('/includes', '', $dir);
	$dir = str_replace('/plugins/USERS_MGMT', '', $dir);

	require($dir . '/includes/configs/config.inc.php');
	require(DIR_INC . 'core.inc.php');

	switch($_REQUEST['action']){

		case 'traductions':

			require(DIR_PLUG . 'USERS_MGMT/langs/' . $_COOKIE[COOKIE_LANG] . '.php');
			echo json_encode($LANG);

			break;

		case 'table_fields':

			echo json_encode(USERS_MGMT::get_table_fields($_REQUEST['table'], true));

			break;

	}//fin switch