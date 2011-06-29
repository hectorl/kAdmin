<?php
	/**
	 * Clase controladora
	 * 
	 * @author		Héctor Laura
	 */
	class KADMIN_C{
		/**
		 * Guardamos el objeto creado que contendrá todos los métodos de Smarty
		 * @var object
		 */
		public $smarty = null;
		/**
		 * Mensajes devueltos
		 */
		public $msg = array();
		/**
		 * 
		 */
		public $plugin = null;


		/**
		 * Contiene el enlace a la base de datos
		 */
		private $_bdLink;


		/**
		 * Array con la traducción al idioma deseado
		 */
		//public $_lang = null;
		/**
		 * Código del idioma del usuario
		 */
		//public $_cLang = null;


		/**
		 * Constructor de la clase. Asigna las variables básicas a Smarty así como las básicas que usará k!Admin
		 * @param $smarty
		 */
		public function __construct($smarty){
//new LOG('OLE!', 'no plugin', 'Mi primer mensaje en el log!');
			//Plugins necesarios
			set_include_path(get_include_path() . PATH_SEPARATOR . DIR_PLUG . 'BROWSER_DETECTION');
			set_include_path(get_include_path() . PATH_SEPARATOR . DIR_PLUG . 'PLUGINS_MGMT');
			set_include_path(get_include_path() . PATH_SEPARATOR . DIR_PLUG . 'USERS_MGMT');
			
			$this->smarty = $smarty;

			$this->smarty->assign('TITLE', TITLE);			
			$this->smarty->assign('URL', 	 URL_KAD);
			$this->smarty->assign('IMG', 	 URL_IMG);
			$this->smarty->assign('CSS', 	 URL_CSS);
			$this->smarty->assign('JS', 	 URL_JS);
			$this->smarty->assign('URL_PLUG', 	 URL_PLUG);
			$this->smarty->assign('DIR_PLUG', DIR_PLUG);

			$this->smarty->setTemplateDir(DIR_REAL . 'smarty/templates/');
			$this->smarty->setCompileDir(DIR_REAL . 'smarty/templates_c/');
			$this->smarty->setConfigDir(DIR_REAL . 'smarty/configs/');
			$this->smarty->setCacheDir(DIR_REAL . 'smarty/cache/');

			//$this->_cLang = $this->set_lang();
			require(DIR_LANGS . $this->set_lang() . '.php');
			$this->_lang = $LANG;

			$this->_GET = $this->get_URL_vars();


			if(file_exists(K_CONFIG)){

				$this->get_db_data();

			}//fin if

			
			//$this->smarty->assign('lang',  $this->_lang);
			//$this->smarty->assign('cLang', $this->_cLang);

		}//fin __construct


		/**
		 * Sacamos la página que queremos visitar.
		 */
		public function get_pagina($posicion = 2){

			$browser = new BROWSER_DETECTION($this->smarty);
			$tpl = $browser->tpl;
			$this->plugin = 'BROWSER_DETECTION';

			if($tpl == null){

				if(!file_exists(K_CONFIG)){

					$this->plugin = 'INSTALL';

				}elseif(!isset($_SESSION[SESSION_NAME])){

					$this->plugin = 'USERS_MGMT';

				}else{

					$this->smarty->assign('session', $_SESSION[SESSION_NAME]);

					if(!isset($this->_GET['plugin'])){

						$this->plugin = 'USERS_MGMT';

					}else{
	
						$this->plugin = $this->_GET['plugin'];
	
					}//fin else

				}//fin else

				//$object = new $this->plugin($this->smarty);

				require(DIR_PLUG . $this->plugin . '/init.php');

				$tpl = $object->tpl;

			}//fin if

			//Sacamos los tpls que se cargaran en las distintas areas, los css y los js
			$this->get_layout($tpl);

			return $tpl;

		}//fin get_pagina


		/**
		 * 
		 */
		private function get_layout($tpl){

			$plugins = new PLUGINS_MGMT($this->smarty);
			$plugins_active = $plugins->get_plugins(true);

			if($tpl['in_main']){

				$this->smarty->assign('layout', $plugins->get_xml_templates($plugins_active));

			}//fin if

			$styles  = $plugins->get_css_files($plugins_active, $tpl, $this->plugin);
			$scripts = $plugins->get_js_files($plugins_active, $tpl, $this->plugin);

			$this->smarty->assign('css_styles',  $styles);
			$this->smarty->assign('js_scripts', $scripts);

			//$this->smarty->assign('tpl', 	$tpl['inc']);

		}//fin get_layout


		/**
		 * 
		 */
		private function get_submit_token(){

			return $_SESSION['submit_token'] = md5(uniqid(rand(), true));

		}//fin get_submit_token


		/**
		 * 
		 */
		public function get_db_data(){

			$ini = new INI(K_CONFIG);
			$ini_data = $ini->get_ini(true);

			define('DB_HOST', $ini_data['data_base']['HOST']);
			define('DB_USER', $ini_data['data_base']['USER']);
			define('DB_PASS', $ini_data['data_base']['PASS']);
			define('DB_DB',   $ini_data['data_base']['DB']);
			define('K_USER',  $ini_data['superadmin']['USER']);
			define('K_PASS',  $ini_data['superadmin']['PASS']);
			define('P_NAME',  $ini_data['project']['NAME']);
			define('P_LANG',  $ini_data['project']['DEFAULT_LANG']);
			define('P_GRPS',  $ini_data['project']['GROUP_USERS']);

		}//fin get_connect_db



		/**
		 * 
		 */
		private function get_URL_vars(){

			if(isset($_GET)){

				return $_GET;

			}else{

				return null;

			}//fin else

		}//fin get_URL_vars



		/**
		 * Establece el lenguaje de la API guardando el valor en una cookie
		 * 
		 * 1º comprueba si se ha mandado el combo de idiomas y si éxiste el archivo del idioma
		 * 2º comprueba si existe la cookie
		 * 3º comprueba si existe el archivo del idioma
		 * 4º en caso de no cumplirse ninguna de las comprobaciones, se establece el idioma en inglés
		 * 
		 * @return		$lang		Las siglas del idioma
		 */
		public function set_lang(){
			
			if(!isset($_COOKIE[COOKIE_LANG])){

				setcookie(COOKIE_LANG, 'EN', COOKIE_EXP, '/');
				$lang = 'EN';

			}elseif(!file_exists(DIR_LANGS . $_COOKIE[COOKIE_LANG] . '.php')){				

				setcookie(COOKIE_LANG, '', time()-3600, '/');
				setcookie(COOKIE_LANG, 'EN', COOKIE_EXP, '/');
				$lang = 'EN';

			}else{

				$lang = $_COOKIE[COOKIE_LANG];

			}//fin else

			return $lang;

		}//fin get_lang


		public function __destruct(){

		}//fin __destruct


		/**
		 * 
		 */
		public function dump($arr){

			echo '<pre>';
			var_dump($arr);
			echo '</pre>';

		}//fin dump


		/**
		 * 
		 */
		public function get_memory(){

			echo "<div style='font-size:20px; text-align:center; line-height:50px;position:fixed; bottom:10px; 
							height:50px; width:500px; background-color:#687061; z-index:100'>
					<p>Using ", memory_get_peak_usage(1) / 1024, " Kbytes of ram.</p>
				 </div>";

		}//fin get_memory

	}//fin clase