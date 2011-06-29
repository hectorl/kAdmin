<?php

	class PLUGINS_MGMT{

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
/*
			if($bdLink != null){

				$this->_bdLink = $bdLink;

			}//fin if
*/
			$lang = $this->set_lang();

			require(dirname(__FILE__) . '/langs/' . $lang . '.php');			

			//$this->_lang = $LANG;
			
			//$this->smarty->assign('lang',  $this->_lang);

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


		/**
		 * Saca el listado de plugins
		 * 
		 * TODO: sistema para sacar activos e inactivos
		 */
		public function get_plugins($active = false){

			$plugins = array();

			$dir = opendir(DIR_PLUG);

			while(($file = readdir($dir)) !== false){

				if(file_exists(DIR_PLUG . $file . '/active')){

					$plugins[] = $file; 

				}//fin if

			}//fin while

			closedir($dir);

			return $plugins;

		}//fin get_plugins


		/**
		 * 
		 */
		public function get_xml_templates($plugins){

			foreach($plugins as $plugin){

				if(file_exists(DIR_PLUG . $plugin . '/config.xml')){

					$xml_file = DIR_PLUG . $plugin . '/config.xml'; 
					$xml = simplexml_load_file($xml_file);
	
					$default_lang = (string)$xml['lang'];
	
					foreach($xml->templates->tpl as $tpl){
	
						$tpls[(string)$tpl->side][] = array('dir'    => DIR_PLUG . $plugin . '/tpl/' . (string)$tpl->dir,
													 'access' => (string)$tpl->access);  
	
						if(isset($tpl->nav)){
	
							$tpls['nav'][] = $this->parse_nav_buttons($plugin, $tpl->nav->button, (string)$tpl->dir, $default_lang);
	
						}//fin if
	
					}//fin foreach

				}//fin if

			}//fin foreach

			return $tpls;

		}//fin get_xml_sections


		/**
		 * Parsea los botones de navegación y devuelve un array con el idioma correcto
		 */
		private function parse_nav_buttons($plugin, $buttons, $dir, $default_lang){

			foreach($buttons as $button){

				$lang_button = (string)$button['lang'];

				if($lang_button == $_COOKIE[COOKIE_LANG]){

					$current_lang = array('button' => (string)$button,
									   'href'   => $dir,
									   'plugin' => $plugin);

				}elseif($lang_button == $default_lang){

					$default_nav = array('button' => (string)$button,
							   		 'href'   => $dir,
							   		 'plugin' => $plugin);

				}//fin else

			}//fin foreach

			return (isset($current_lang)) ? $current_lang : $default_nav;

		}//fin parse_nav_buttons


		/**
		 * 
		 */
		public function get_css_files($plugins, $template, $active_plugin){

			if($template['in_main']){

				foreach($plugins as $plugin){

					if(file_exists(DIR_PLUG . $plugin . '/config.xml')){

						$xml_file = DIR_PLUG . $plugin . '/config.xml';
						
						$xml = simplexml_load_file($xml_file);
	
						foreach($xml->templates->tpl as $tpl){
	
							if(sizeof($tpl->styles) > 0){
	
								foreach($tpl->styles->css as $css){

									if($template['inc'] == (string)$tpl->dir){

										$styles[] = URL_PLUG . $plugin . '/css/' . (string)$css;

									}elseif((string)$tpl->side != 'in_main' && (string)$tpl->side != 'content'){

										$styles[] = URL_PLUG . $plugin . '/css/' . (string)$css;
	
									}//fin else  
		
								}//fin foreach
		
							}//fin if
		
						}//fin foreach

					}//fin if

				}//fin foreach

			}else{

				$xml_file = DIR_PLUG . $active_plugin . '/config.xml'; 
				$xml = simplexml_load_file($xml_file);

				foreach($xml->templates->tpl as $tpl){

					if(sizeof($tpl->styles) > 0){

						foreach($tpl->styles->css as $css){

							if($template['inc'] == (string)$tpl->dir){
	
								$styles[] = URL_PLUG . $active_plugin . '/css/' . (string)$css;

							}//fin if

						}//fin foreach

					}//fin if

				}//fin foreach

			}//fin else

			return $styles;

		}//fin get_css_files


		/**
		 * 
		 */
		public function get_js_files($plugins, $template, $active_plugin){

			$scripts = null;

			if($template['in_main']){

				foreach($plugins as $plugin){

					if(file_exists(DIR_PLUG . $plugin . '/config.xml')){

						$xml_file = DIR_PLUG . $plugin . '/config.xml'; 
						$xml = simplexml_load_file($xml_file);
		
						foreach($xml->templates->tpl as $tpl){

							if(isset($tpl->scripts->js)){

								foreach($tpl->scripts->js as $js){		
			
									if((string)$tpl->side == 'in_main' && $template == (string)$tpl->dir){
			
										$scripts[] = URL_PLUG . $plugin . '/js/' . (string)$js;
			
									}elseif((string)$tpl->side != 'in_main'){
			
										$scripts[] = URL_PLUG . $plugin . '/js/' . (string)$js;
			
									}//fin else
			
								}//fin foreach

							}//fin if

						}//fin foreach

					}//fin if

				}//fin foreach

			}else{

				if(file_exists(DIR_PLUG . $plugin . '/config.xml')){

					$xml_file = DIR_PLUG . $active_plugin . '/config.xml'; 
					$xml = simplexml_load_file($xml_file);
	
					foreach($xml->templates->tpl as $tpl){
	
						if(sizeof($tpl->scripts) > 0){
	
							foreach($tpl->scripts->js as $js){
	
								if($template['inc'] == (string)$tpl->dir){
		
									$scripts[] = URL_PLUG . $active_plugin . '/js/' . (string)$js;
	
								}//fin if
	
							}//fin foreach
	
						}//fin if
	
					}//fin foreach

				}//fin if

			}//fin else

			return $scripts;

		}//fin get_js_files

	}//fin PLUGINS_MGMT