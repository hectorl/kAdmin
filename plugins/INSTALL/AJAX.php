<?php

	$ruta_real = dirname(__FILE__);
	//$dir = str_replace('\\', '/', $ruta_real);
	$dir = str_replace('/plugins/INSTALL', '/', $ruta_real);

	require($dir . 'includes/configs/config.inc.php');
	require(DIR_INC . 'core.inc.php');


	if($_REQUEST['action'] == 'chkConnection'){

		echo json_encode(DB::check_connection($_REQUEST['host'], $_REQUEST['user'], $_REQUEST['pass'], $_REQUEST['db']));

	}//fin if