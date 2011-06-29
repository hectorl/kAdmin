<?php

	/**
	 * Mantenimiento de usuarios y grupos
	 *
	 * @package default
	 * @author  Héctor Laura <hector.laura@fishbowl.es>
	 */
	class USERS_MGMT implements PLUGIN{

		/**
		 * 
		 */
		public $tpl = null;
		/**
		 * 
		 */
		public $smarty;
		/**
		 * 
		 */
		private $_lang;


		/**
		 * 
		 */
		public function __construct($smarty){

			//registramos el directorio con el resto de librerías
			set_include_path(get_include_path() . PATH_SEPARATOR . DIR_PLUG . 'USERS_MGMT/libs');

			$this->smarty = $smarty;

			$this->set_lang();

			if(isset($_POST['USERS_MGMT-submit']) && $_SERVER['REQUEST_METHOD'] == 'POST'){

				$tpl = $this->do_post();

			}elseif(!isset($_SESSION[SESSION_NAME])){

				$tpl = array('in_main' => false, 'inc' => 'site.login.tpl');

			}elseif(!isset($_GET['action'])){
					
				$tpl = $this->do_tpl('user_welcome');
				$tpl = array('in_main' => true, 'inc' => 'site.user_welcome.tpl');

			}else{

				$tpl = $this->do_tpl($_GET['action']);

			}//fin else

			$this->tpl = $tpl;

		}//fin __construct


		/**
		 * 
		 */
		public function do_post(){

			switch($_POST['USERS_MGMT-submit']){

				case $this->_lang['submit']['login']:

					$tpl = $this->do_login();

					break;

				case $this->_lang['submit']['user_data']:

					$tpl = $this->do_your_data();

					break;

				case $this->_lang['submit']['users_table']:			

					$tpl = $this->do_users_table();

					break;

			}//fin switch

			return $tpl;

		}//fin do_post


		/**
		 * 
		 */
		public function do_tpl($action){

			switch($action){

				case 'user_welcome':

					$this->smarty->assign('users_mgmt_installed', $this->check_config_file());

					return array('in_main' => true, 'inc' => 'site.user_list.tpl');

					break;

				case 'users_table':

					$this->smarty->assign('db_tables', $this->get_db_tables());

					return array('in_main' => true, 'inc' => 'site.users_table.tpl');

					break;

				case 'your_data':

					return $this->do_your_data();

					break;

				case 'users_list':

					return array('in_main' => true, 'inc' => 'site.users_list.tpl');

					break;

				case 'signout':

					session_unset();
					session_destroy();
					header('Location: ' . URL_KAD);

					break;

			}//fin switch

		}//fin do_tpl


		/**
		 * Establece el lenguaje
		 */
		public function set_lang(){

			if(!isset($_COOKIE[COOKIE_LANG])){	

				$lang = 'EN';

			}elseif(!file_exists(dirname(__FILE__) . '/langs/' . $_COOKIE[COOKIE_LANG] . '.php')){

				$lang = 'EN';

			}else{

				$lang = $_COOKIE[COOKIE_LANG];

			}//fin else

			require(dirname(__FILE__) . '/langs/' . $lang . '.php');			

			$this->_lang = $LANG;

			$this->smarty->assign('lang',  $this->_lang);

		}//fin set_lang


		/**
		 * 
		 */
		private function do_login(){

			$user = new USERS(T_USERS, 'id', SESSION_NAME);

			$fields = array('user' => $_POST['user'], 'pass' => sha1($_POST['pass']));

			$data_user = $user->check_user_exists($fields);

			if($data_user){

				$user->set_session($data_user);
				$this->smarty->assign('session', $_SESSION[SESSION_NAME]);

				header('Location:' . URL_KAD);
				exit();					

			}else{

				$tpl = array('in_main' => false, 'inc' => 'site.login.tpl');
				$msg = array('type' => 'error', 'text' => $this->_lang['msg']['user_wrong']);
				$this->smarty->assign('msg', $msg);

			}//fin else

			return $tpl;

		}//fin do_login


		/**
		 * 
		 */
		private function do_your_data(){

			if($_SERVER['REQUEST_METHOD'] == 'POST'){

				if(strlen(trim($_POST['name'])) > 0){

					require(dirname(__FILE__) .  '/libs/class.USERS.php');
	
					$fields = array();
	
					$user = new USERS(T_USERS, 'id', SESSION_NAME, $this->_bdLink);
	
					$resp = $user->check_change_pass($_POST['old_pass'], $_POST['pass'], $_POST['re_pass']);
	
					switch($resp){
	
						case 0://With new pass
	
							$fields = array('name'  => $_POST['name'],
										 'email' => $_POST['email'],
										 'pass'  => sha1(trim($_POST['pass'])));
	
							break;
	
						case 1://Without new pass
	
							$fields = array('name'  => $_POST['name'],
										 'email' => $_POST['email']);
	
							break;
	
						case 2:
	
							$msg = array('type' => 'warning', 'text' => $this->_lang['msg']['error_data_update_2']);
	
							break;
	
						case 3:
	
							$msg = array('type' => 'warning', 'text' => $this->_lang['msg']['error_data_update_3']);
	
							break;
	
						case 4:
	
							$msg = array('type' => 'warning', 'text' => $this->_lang['msg']['error_data_update_4']);
	
							break;
	
						case 5:
	
							$msg = array('type' => 'warning', 'text' => $this->_lang['msg']['error_data_update_5']);
	
							break;
	
					}//fin switch
	
					if($resp === 0 || $resp === 1){
	
						$msg = ($user->set_user($fields, $_SESSION[SESSION_NAME]['id'])) ?
			
								array('type' => 'success', 'text' => $this->_lang['msg']['user_data_updated']) :
								array('type' => 'error', 'text' => $this->_lang['msg']['error_updating_data']);					
	
						if($msg['type'] == 'success'){
	
							$user->set_session($user->get_user($_SESSION[SESSION_NAME]['id']));
							$this->smarty->assign('session', $_SESSION[SESSION_NAME]);
	
						}//fin if
	
					}//fin if					
	
				}else{

					$msg = array('type' => 'warning', 'text' => $this->_lang['msg']['error_data_update_name']);

				}//fin else

				$this->smarty->assign('msg', $msg);

			}//fin if

			return array('in_main' => true, 'inc' => 'site.user_data.tpl');

		}//fin do_user_data


		/**
		 * 
		 */
		private function get_db_tables(){

			$db = DB::init();

			$db->show();
			$db->fields(array('TABLES'));
			
			$tables = $db->execute();

			$options = array('' => 'Selecciona una tabla...');

			foreach($tables as $table){

				$options[$table] = $table;

			}//fin foreach
		
			return $options;
		
		}//fin get_db_tables


		/**
		 * Acciones al guardar la tabla de usuarios 
		 */
		private function do_users_table(){
echo '<pre>';
//var_dump($_POST);
echo '</pre>';
			$fields = array();

			foreach($_POST as $field => $val){

				foreach($val as $value){
echo $field . ' ';
					$fields[$field][] = $value;

				}//fin foreach

			}//fin foreach

echo '<pre>';
var_dump($fields);
echo '</pre>';

		}//fin do_users_table


		/**
		 * 
		 */
		public function get_table_fields($table, $ajax_call = false){

			$db = DB::init();

			$db->show();
			$db->tables($table);
			$db->fields(array('COLUMNS'));

			return $db->execute();

		}//fin get_table_fields


		/**
		 * 
		 */
		private function check_config_file(){

			return file_exists(DIR_PLUG . 'USERS_MGMT/config.ini');

		}//fin check_users_config

	}//fin  USERS_MGMT