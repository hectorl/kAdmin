<?php

	require(DIR_SMARTY . 'Smarty.class.php');
	require(DIR_LIBS . 'interface.PLUGIN.php');

	session_start();

	set_include_path(DIR_LIBS);
	spl_autoload_register('load_libreries');

	/**
	 * Carga las librerias según se soliciten
	 */
	function load_libreries($lib){

		try{
			/*
			if(!file_exists(DIR_LIBS . 'class.' . $lib . '.php') && file_exists(DIR_PLUG . $lib)){

				set_include_path(get_include_path() . PATH_SEPARATOR . DIR_PLUG . $lib);

			}elseif(!file_exists(DIR_LIBS . 'class.' . $lib . '.php')){

				throw new Exception('File does not exist: <b>' . $lib . '</b>');

			}//fin else
			*/
			require('class.' . $lib . '.php');

		}catch(Exception $e){

			echo '<p>Excepción capturada: ',  $e->getMessage(), "</p>";

		}//fin catch

	}//fin load_libreries



	try{
 
  		$smarty = new Smarty();
		$p = new KADMIN_C($smarty);		

	}catch(Exception $e){

		die('Ha ocurrido un error:<br/>' . $e);

	}//fin catch