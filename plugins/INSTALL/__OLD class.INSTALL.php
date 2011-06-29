<?php
	/**
	 * Hace todo lo relacionado con la instalación
	 * 
	 * @author	Héctor Laura
	 */
	
	class INSTALL implements PLUGIN{

		/**
		 * 
		 */
		public $tpl = null;
		/*
		 * 
		 */
		public $smarty = null;

		/**
		 * 
		 */
		private $_lang = array();



		/**
		 * 
		 */
		public function __construct($smarty){

			$this->smarty = $smarty;
			$this->set_lang();

			$this->smarty->assign('countries', $this->get_countries_langs());

			if($_SERVER['REQUEST_METHOD'] == 'POST'){

				$this->do_post();

			}//fin if

			$this->tpl = array('in_main' => false, 'inc' => 'site.install.tpl');

		}//fin __construct


		/**
		 * 
		 */
		public function do_post(){

			if(isset($_POST['submitInstall'])){

				$this->init_install();

				header('Location:' . URL_KAD);
				exit();

			}//fin if

		}//fin do post


		/**
		 * Establece el lenguaje de la API guardando el valor en una cookie
		 * 
		 * 1º comprueba si se ha mandado el combo de idiomas y si éxiste el archivo del idioma
		 * 2º comprueba si existe el archivo del idioma
		 * 3º en caso de no cumplirse ninguna de las comprobaciones, se establece el idioma en inglés
		 * 
		 * @return		$lang		Las siglas del idioma
		 */
		public function set_lang(){
			
			if(isset($_POST['lang']) && file_exists(DIR_LANGS . $_POST['lang'] . '.php')){

				setcookie(COOKIE_LANG, $_POST['lang'], COOKIE_EXP, '/');
				$lang = $_POST['lang'];

			}elseif(!isset($_COOKIE[COOKIE_LANG])){	

				setcookie(COOKIE_LANG, 'EN', COOKIE_EXP, '/');
				$lang = 'EN';

			}elseif(!file_exists(DIR_PLUG . 'INSTALL/langs/' . $_COOKIE[COOKIE_LANG] . '.php')){

				setcookie(COOKIE_LANG, '', time() - 3600, '/');
				setcookie(COOKIE_LANG, 'EN', COOKIE_EXP, '/');
				$lang = 'EN';

			}else{

				$lang = $_COOKIE[COOKIE_LANG];

			}//fin else

			require(DIR_PLUG . 'INSTALL/langs/' . $lang . '.php');			

			$this->_lang = $LANG;

			$this->smarty->assign('lang',  $this->_lang);
			$this->smarty->assign('cLang', $lang);

		}//fin get_lang



		/**
		 * Inicia la instalación
		 */
		private function init_install(){

			$this->set_k_DB();
			/*
			$this->get_db_data();

			$this->set_tables();

			if(isset($_POST['group_users'])){

				$this->set_first_group();

			}//fin if

			$this->set_first_user();			

			*/
			header('Location:' . URL_KAD);
			exit();

		}//fin init_install


		/**
		 * Contiene los idiomas del select de idiomas
		 */
		public function get_countries_langs(){

			$countriesLangs = array(
							'ES' => $this->_lang['langs']['spanish'],
							'EN' => $this->_lang['langs']['english'],
							'GR' => $this->_lang['langs']['german']
						);

			return $countriesLangs;

		}//fin get_countries_langs


		/**
		 * 
		 */
		public function set_k_DB(){

			$data = array('data_base' => 
						array(
							'HOST' => $_POST['host'],
							'DB'   => $_POST['db'],
							'USER' => $_POST['user'],
							'PASS' => $_POST['pass']
						),
						'superadmin' =>
						 array(
						 	'USER' => $_POST['user_kadmin'],
						 	'PASS' => sha1($_POST['pass_kadmin'])
						 ),
						'project' =>
						 array(
							'NAME' 		=> $_POST['project'],
							'DEFAULT_LANG' => $_COOKIE[COOKIE_LANG],
							'MULTILANG'    => (isset($_POST['multilang'])) ? 1 : 0,
							'GROUP_USERS'  => (isset($_POST['group_users'])) ? 1 : 0
						 )
					);

			$ini = new INI(K_CONFIG);
			$ini->create_ini($data);

		}//fin set_k_BD


		/**
		 * 
		 */
		public function set_tables(){

			$fail = false;

			$fields = array();
			$keys = array();

			$db = DB::init();

			$db->begin($this->_bdLink);

			//TABLES_ALIAS
			$db->create('IF NOT EXISTS', $this->_bdLink);
			$db->tables(array(T_TABLES_ALIAS));

			$fields[] = array('id', 'int(11)', 'NOT NULL AUTO_INCREMENT', 'Table id');
			$fields[] = array('table', 'varchar(64)', 'NOT NULL', 'Database table');
			
			if(isset($_POST['multilang'])){
			
				$fields[] = array('alias', 'varchar(255)', 'NOT NULL', 'Table alias');
				$fields[] = array('description', 'varchar(255)', 'NOT NULL', 'Table comment. Some kind of description');

			}//fin if

			$fields[] = array('type', "enum('db','ini')", 'NOT NULL', 'Table type: From DB or from .ini file');			
			$fields[] = array('order', 'int(11)', "unsigned NOT NULL DEFAULT '0'", 'Position of the section');
			$fields[] = array('who', 'int(11)', 'NOT NULL', 'User id');
			$fields[] = array('date_insert', 'datetime', 'NOT NULL', 'Creation date');
			$fields[] = array('date_update', 'timestamp', 'NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 'Last update date');
			$db->fields($fields);

			$keys[] = array('id', 'PRIMARY KEY');
			$db->keys($keys);

			$db->tail('InnoDB', 'utf8', 'Contains all table alias', 1);

			if(!$db->execute()){

				$fail = true;

			}//fin if

			$fields = array();
			$keys = array();
			

			//FIELDS_ALIAS
			$db->create('IF NOT EXISTS', $this->_bdLink);
			$db->tables(array(T_FIELDS_ALIAS));

			$fields[] = array('id', 'int(11)', 'NOT NULL AUTO_INCREMENT', 'Field id');
			$fields[] = array('idTable', 'int(11)', 'NOT NULL', 'Table id');
			$fields[] = array('field', 'varchar(64)', 'NOT NULL', 'Table field');

			if(isset($_POST['multilang'])){

				$fields[] = array('alias', 'varchar(255)', 'NOT NULL', 'Field alias');
				$fields[] = array('description', 'varchar(255)', 'NOT NULL', 'Table comment. Some kind of description');

			}//fin if

			$fields[] = array('list', 'tinyint(1)', 'NOT NULL', 'Show or not in records lists');			
			$fields[] = array('order', 'int(11)', "unsigned NOT NULL DEFAULT '0'", 'Position of the filed in the form');
			$fields[] = array('who', 'int(11)', 'NOT NULL', 'User id');
			$fields[] = array('date_insert', 'datetime', 'NOT NULL', 'Creation date');
			$fields[] = array('date_update', 'timestamp', 'NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 'Last update date');
			$db->fields($fields);

			$keys[] = array('id', 'PRIMARY KEY');
			$keys[] = array('idTable', 'idTable');
			$db->keys($keys);

			$db->tail('InnoDB', 'utf8', 'Contains all fields alias', 1);

			if(!$db->execute()){

				$fail = true;

			}//fin if

			$fields = array();
			$keys = array();


			//LANGS
			if(isset($_POST['multilang'])){

				$db->create('IF NOT EXISTS', $this->_bdLink);
				$db->tables(array(T_LANGS));

				$fields[] = array('id', 'int(11)', 'NOT NULL AUTO_INCREMENT', 'Field id');
				$fields[] = array('idTable', 'int(11)', 'NOT NULL', 'Id of the table');
				$fields[] = array('idField', 'int(11)', 'NOT NULL', 'Id of the field');			
				$fields[] = array('alias', 'varchar(255)', 'NOT NULL', 'Table or field alias');
				$fields[] = array('lang', 'varchar(3)', 'NOT NULL', 'Lang code in ');
				$fields[] = array('description', 'varchar(255)', 'NOT NULL', 'Table or field comment. Some kind of description');
				$fields[] = array('who', 'int(11)', 'NOT NULL', 'User id');
				$fields[] = array('date_insert', 'datetime', 'NOT NULL', 'Creation date');
				$fields[] = array('date_update', 'timestamp', 'NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 'Last update date');			
				$db->fields($fields);

				$keys[] = array('id', 'PRIMARY KEY');
				$keys[] = array('idTable', 'idTable');
				$keys[] = array('idField', 'idField');
				$db->keys($keys);

				$db->tail('InnoDB', 'utf8', 'Contains all langs alias', 1);

				if(!$db->execute()){
	
					$fail = true;
	
				}//fin if

				$fields = array();
				$keys = array();

			}//fin if


			//USERS
			$db->create('IF NOT EXISTS', $this->_bdLink);
			$db->tables(array(T_USERS));

			$fields[] = array('id', 'int(11)', 'NOT NULL AUTO_INCREMENT', 'Field id');

			if(isset($_POST['group_users'])){

				$fields[] = array('idGroup', 'int(11)', 'NOT NULL', 'Id of the group');

			}//fin if			

			$fields[] = array('name', 'varchar(50)', 'NOT NULL', 'User full name');
			$fields[] = array('user', 'varchar(10)', 'NOT NULL', 'Login user');
			$fields[] = array('pass', 'varchar(45)', 'NOT NULL', 'Login pass');
			$fields[] = array('email', 'varchar(100)', 'NOT NULL', 'User email');
			$fields[] = array('description', 'text', 'NOT NULL', 'User description');
			$fields[] = array('avatar', 'varchar(50)', 'NOT NULL', 'User pic');
			$fields[] = array('access', 'int(11)', 'NOT NULL', 'Level access');
			$fields[] = array('active', 'tinyint(1)', 'NOT NULL', 'Active user or not');
			$fields[] = array('who', 'int(11)', 'NOT NULL', 'User id');
			$fields[] = array('date_insert', 'datetime', 'NOT NULL', 'Creation date');
			$fields[] = array('date_update', 'timestamp', 'NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 'Last update date');
			$db->fields($fields);

			$keys[] = array('id', 'PRIMARY KEY');
			$keys[] = array('name', 'UNIQUE');
			$keys[] = array('user', 'UNIQUE');
			$keys[] = array('email', 'UNIQUE');
			$db->keys($keys);

			$db->tail('InnoDB', 'utf8', 'Contains kadmin users', 1);

			if(!$db->execute()){

				$fail = true;

			}//fin if			

			$fields = array();
			$keys = array();


			//PERMISSIONS
			$db->create('IF NOT EXISTS', $this->_bdLink);
			$db->tables(array(T_PERMISSIONS));

			$fields[] = array('id', 'int(11)', 'NOT NULL AUTO_INCREMENT', 'Field id');
			$fields[] = array('idUser', 'int(11)', 'NOT NULL', 'Id of the user');
			
			if(isset($_POST['group_users'])){

				$fields[] = array('idGroup', 'int(11)', 'NOT NULL', 'Id of the group');

			}//fin if

			$fields[] = array('idTable', 'int(11)', 'NOT NULL', 'Table id');
			$fields[] = array('read', 'tinyint(1)', 'NOT NULL', 'Can or not read the data');
			$fields[] = array('write', 'tinyint(1)', 'NOT NULL', 'Can or not write data');
			$fields[] = array('delete', 'tinyint(1)', 'NOT NULL', 'Can or not delete data');
			$fields[] = array('who', 'int(11)', 'NOT NULL', 'User id');
			$fields[] = array('date_insert', 'datetime', 'NOT NULL', 'Creation date');
			$fields[] = array('date_update', 'timestamp', 'NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 'Last update date');
			$db->fields($fields);

			$keys[] = array('id', 'PRIMARY KEY');
			$keys[] = array('idTable', 'idTable');
			$keys[] = array('idUser', 'idUser');
			$keys[] = array('idGroup', 'idGroup');
			$db->keys($keys);

			$db->tail('InnoDB', 'utf8', 'Contains users permissions', 1);

			if(!$db->execute()){

				$fail = true;

			}//fin if

			$fields = array();
			$keys = array();


			//GROUPS USERS
			if(isset($_POST['group_users'])){

				$db->create('IF NOT EXISTS', $this->_bdLink);
				$db->tables(array(T_USERS_GROUPS));

				$fields[] = array('id', 'int(11)', 'NOT NULL AUTO_INCREMENT', 'Field id');
				$fields[] = array('group_users', 'varchar(255)', 'NOT NULL', 'name of the group');
				$fields[] = array('description', 'varchar(255)', 'NOT NULL', 'User or group comment. Some kind of description');
				$fields[] = array('avatar', 'varchar(50)', 'NOT NULL', 'Group pic');
				$fields[] = array('who', 'int(11)', 'NOT NULL', 'User id');
				$fields[] = array('date_insert', 'datetime', 'NOT NULL', 'Creation date');
				$fields[] = array('date_update', 'timestamp', 'NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 'Last update date');			
				$db->fields($fields);

				$keys[] = array('id', 'PRIMARY KEY');
				$keys[] = array('group_users', 'UNIQUE');
				$db->keys($keys);

				$db->tail('InnoDB', 'utf8', 'Contains the users groups', 1);

				if(!$db->execute()){
	
					$fail = true;
	
				}//fin if

				$fields = array();
				$keys = array();

			}//fin if


			//PLUGINS
			$db->create('IF NOT EXISTS', $this->_bdLink);
			$db->tables(array(T_PLUGINS));

			$fields[] = array('id', 'int(11)', 'NOT NULL AUTO_INCREMENT', 'Plugin id');
			$fields[] = array('plugin', 'varchar(10)', 'NOT NULL', 'Plugin name');
			$fields[] = array('type', 'enum(\'field\',\'section\')', 'NOT NULL', 'Type of plugin: Field or section');
			$fields[] = array('who', 'int(11)', 'NOT NULL', 'User id');
			$fields[] = array('date', 'timestamp', 'NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 'Last update date');
			$db->fields($fields);

			$keys[] = array('id', 'PRIMARY KEY');
			$db->keys($keys);

			$db->tail('InnoDB', 'utf8', 'Contains active plugins', 1);

			if(!$db->execute()){

				$fail = true;

			}//fin if

			$fields = array();
			$keys = array();			


			//PLUGINS ATTRIBUTES
			$db->create('IF NOT EXISTS', $this->_bdLink);
			$db->tables(array(T_PLUGINS_CONF));

			$fields[] = array('id', 'int(11)', 'NOT NULL AUTO_INCREMENT', 'Plugin id');
			$fields[] = array('idPlugin', 'int(11)', 'NOT NULL', 'Plugin id');
			$fields[] = array('attribute', 'varchar(50)', 'NOT NULL', 'Name of the attribute');
			$fields[] = array('value', 'varchar(50)', 'NOT NULL', 'Value of the attribute');
			$fields[] = array('who', 'int(11)', 'NOT NULL', 'User id');
			$fields[] = array('date', 'timestamp', 'NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 'Last update date');
			$db->fields($fields);

			$keys[] = array('id', 'PRIMARY KEY');
			$keys[] = array('idPlugin', 'idPlugin');

			$db->keys($keys);
 
			$db->tail('InnoDB', 'utf8', 'Contains plugins configuration', 1);

			if(!$db->execute()){

				$fail = true;

			}//fin if

			$fields = array();
			$keys = array();			


			//LINK LANGS WITH TABLES ALIAS			
			if(isset($_POST['multilang'])){
						
				$db->prepare('ALTER TABLE ' . T_LANGS . ' ADD FOREIGN KEY ( `idTable` ) REFERENCES ' . T_TABLES_ALIAS . ' (`id`) ON DELETE CASCADE ON UPDATE CASCADE', $this->_bdLink);
	
				if(!$db->execute()){
	
					$fail = true;
	
				}//fin if

			}//fin if


			//LINK LANGS WITH FIELDS ALIAS			
			if(isset($_POST['multilang'])){
			
				$db->prepare('ALTER TABLE ' . T_LANGS . ' ADD FOREIGN KEY ( `idField` ) REFERENCES ' . T_FIELDS_ALIAS . ' (`id`) ON DELETE CASCADE ON UPDATE CASCADE', $this->_bdLink);
				
				if(!$db->execute()){
	
					$fail = true;
	
				}//fin if			

			}//fin if

			//LINK PERMISSIONS WITH USERS
			$db->prepare('ALTER TABLE ' . T_PERMISSIONS . ' ADD FOREIGN KEY ( `idUser` ) REFERENCES ' . T_USERS . ' (`id`) ON DELETE CASCADE ON UPDATE CASCADE', $this->_bdLink);

			if(!$db->execute()){

				$fail = true;

			}//fin if


			//LINK PERMISSIONS WITH GROUPS
			if(isset($_POST['users_group'])){

				$db->prepare('ALTER TABLE ' . T_PERMISSIONS . ' ADD FOREIGN KEY ( `idGroup` ) REFERENCES ' . T_USERS_GROUPS . ' (`id`) ON DELETE CASCADE ON UPDATE CASCADE', $this->_bdLink);
	
				if(!$db->execute()){
	
					$fail = true;
	
				}//fin if

			}//fin if


			//LINK PERMISSIONS WITH TABLES ALIAS
			$db->prepare('ALTER TABLE ' . T_PERMISSIONS . ' ADD FOREIGN KEY ( `idTable` ) REFERENCES ' . T_TABLES_ALIAS . ' (`id`) ON DELETE CASCADE ON UPDATE CASCADE', $this->_bdLink);

			if(!$db->execute()){

				$fail = true;

			}//fin if

			
			//LINK PLUGINS ATTRIBUTES WITH PLUGINS
			$db->prepare('ALTER TABLE `k_plugins_configuration` ADD FOREIGN KEY ( `idPlugin` ) REFERENCES `pruebas_kadmin`.`k_plugins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE', $this->_bdLink);

			if(!$db->execute()){

				$fail = true;

			}//fin if


			//LINK FIELDS ALIAS WITH TABLES ALIAS
			$db->prepare('ALTER TABLE ' . T_FIELDS_ALIAS . ' ADD FOREIGN KEY ( `idTable` ) REFERENCES ' . T_TABLES_ALIAS . ' (`id`) ON DELETE CASCADE ON UPDATE CASCADE', $this->_bdLink);

			if(!$db->execute($this->_bdLink)){

				$fail = true;

			}//fin if

			if(!$fail){
					
				$db->commit($this->_bdLink);
				
			}else{

				echo '<p>' . mysql_error() . '</p>';
				$db->rollback($this->_bdLink);
				exit();

			}//fin else

		}//fin set_tables


		/**
		 * 
		 */
		private function set_first_group(){

			require(DIR_PLUG .  'USERS_MGMT/libs/class.USERS_GROUPS.php');

			$fields = array('group_users' => 'superadministrators',
						 'description' => 'Grupo de superamdinistradores con pleno control sobre k!Admin',
						 'date_insert'=> date('Y-m-d H:i'));

			$group = new USERS_GROUPS(T_USERS_GROUPS, 'id', $this->_bdLink);

			$group->set_group($fields);			

		}//fin set_first_group


		/**
		 * 
		 */
		private function set_first_user(){

			require(DIR_PLUG .  'USERS_MGMT/libs/class.USERS.php');

			$fields = array();

			$fields = array('name' => $_POST['user_kadmin'],
						 'user' => $_POST['user_kadmin'],
						 'pass' => sha1($_POST['pass_kadmin']),
						 'description' => 'Primer superadministrador',
						 'date_insert'=> date('Y-m-d H:i'));

			if(isset($_POST['group_users'])){

				$fields['idGroup'] = 1;

			}//fin if

			$user = new USERS(T_USERS, 'id', '', $this->_bdLink);
			$user->set_user($fields);			

		}//fin set_first_group


		/**
		 * 
		 */
		public function dump($arr){

			echo '<pre>';
			var_dump($arr);
			echo '</pre>';

		}//fin dump

	}//fin INSTALL
