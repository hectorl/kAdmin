<?php
	/**
	 * @author		Héctor Laura
	 */
	
	header('Content-type: text/javascript');
	
	$rutaReal = dirname(__FILE__);
	$dir = str_replace('\\', '/', $rutaReal);
	$dir = str_replace('/js', '', $dir);
	$dir = str_replace('/includes', '', $dir);
	$dir = str_replace('/plugins/USERS_MGMT', '', $dir);

	require($dir . '/includes/configs/config.inc.php');
	require(DIR_PLUG . 'USERS_MGMT/langs/' . $_COOKIE[COOKIE_LANG] . '.php');

	echo json_encode($LANG);
	
?>

