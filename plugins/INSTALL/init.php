<?php

	try{

		set_include_path(get_include_path() . PATH_SEPARATOR . DIR_PLUG . 'INSTALL');
		$object = new INSTALL($this->smarty);

	}catch(Exception $err){
	
	
	
	}//fin catch
	