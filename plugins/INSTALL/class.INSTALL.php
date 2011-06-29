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


		public function do_tpl($action){}


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
		public function dump($arr){

			echo '<pre>';
			var_dump($arr);
			echo '</pre>';

		}//fin dump

	}//fin INSTALL
