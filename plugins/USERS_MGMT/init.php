<?php

	try{

		$object = new USERS_MGMT($this->smarty);

	}catch(Exception $err){
	
		echo $err->getMessage();
	
	}//fin catch
	