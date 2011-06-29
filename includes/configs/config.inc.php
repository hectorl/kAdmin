<?php
	
	/**
	 * Archivo de confirguración de la API
	 * 
	 * @author		Héctor Laura
	 */

	//RUTAS

		//Reales
		define('DIR_PRY',    $_SERVER['DOCUMENT_ROOT'] . '/', false);
		define('DIR_REAL',   $dir . '/', false);
		define('DIR_PLUG',   DIR_REAL . 'plugins/', false);
		define('DIR_INC',    DIR_REAL . 'includes/', false);
		define('DIR_CONF',   DIR_INC . 'configs/', false);
		define('DIR_LANGS',  DIR_INC . 'langs/', false);
		define('DIR_LIBS',   DIR_INC . 'libs/', false);
		define('DIR_SMARTY', DIR_INC . 'libs/SMARTY/', false);


		//URL
		define('URL_KAD', 	   	'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']), false);
		define('URL_CSS', 	  	URL_KAD . 'css/', false);
		define('URL_JS', 	   	URL_KAD . 'js/', false);
		define('URL_IMG', 		URL_KAD . 'img/', false);
		define('URL_PLUG', 	   	URL_KAD . 'plugins/', false);


	//TABLAS
		define('PREF_TABL', 'k_', false);
		define('T_TABLES_ALIAS', PREF_TABL . 'tables_alias', false);
		define('T_FIELDS_ALIAS', PREF_TABL . 'fields_alias', false);
		//define('T_FIELDS_ATTRI', PREF_TABL . 'fields_attributes', false);
		define('T_LANGS', 		PREF_TABL . 'langs', false);
		define('T_PLUGINS', 	PREF_TABL . 'plugins', false);
		define('T_PLUGINS_CONF', PREF_TABL . 'plugins_configuration', false);
		define('T_USERS', 		PREF_TABL . 'users', false);
		define('T_USERS_GROUPS', PREF_TABL . 'users_groups', false);
		define('T_PERMISSIONS',  PREF_TABL . 'permissions', false);

	//SESIONES
		define('SESSION_NAME', 'kadmin_user', false);
          define('SESSION_EXPIRES', 36000, false);

	//COOKIES
		define('COOKIE_EXP', time() + 60 * 60 * 24 * 365, false);//One year
		define('COOKIE_LANG', 'kadmin_lang', false);

	//ARCHIVO DE CONFIGURACIÓN (localización + nombre)
		define('K_CONFIG', DIR_CONF . 'kadmin_config.ini', false);
		define('LOG_FILE', DIR_CONF . 'kadmin.log', false);

	//OTRAS CONSTANTES DE INTERÉS

		$url = explode('/',  $dir);
		$carpeta_gestor = array_pop($url);

		define('DIR_KADMIN', $carpeta_gestor, false);

		/**
		 * Posición de las páginas del gestor en la url
		 * @var int
		 */
		define('POS_PAG', 2, false);

		define('TITLE', 'k!Admin', false);