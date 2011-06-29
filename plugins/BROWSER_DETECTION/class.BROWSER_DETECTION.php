<?php

	class BROWSER_DETECTION{

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

			$this->smarty = $smarty;

			require(dirname(__FILE__) . '/libs/class.BROWSER.php');

			$browser = new BROWSER();

			if($browser->Name == 'msie' && $browser->Version < 8){

				$this->tpl = array('in_main' => false, 'inc' => 'site.no_more_ie.tpl');

				$lang = $this->set_lang();
	
				require(dirname(__FILE__) . '/langs/' . $lang . '.php');

				$this->_lang = $LANG;			
				$this->smarty->assign('lang',  $this->_lang);

			}//fin if

			return $this->tpl;

		}//fin __construct


		/**
		 * 
		 */
		public function set_lang(){

			if(!isset($_COOKIE[COOKIE_LANG])){	

				$lang = 'EN';

			}elseif(!file_exists(dirname(__FILE__) . '/langs/' . $_COOKIE[COOKIE_LANG] . '.php')){

				$lang = 'EN';

			}else{

				$lang = $_COOKIE[COOKIE_LANG];

			}//fin else

			return $lang;

		}//fin set_lang

	}//fin BROWSER_DETECTION
