<?php

	/**
	 * @author		http://snipplr.com/view.php?codeview&id=35627
	 */

	class BROWSER{
	
		private $props = array("Version" => "0.0.0",
	                             "Name" => "unknown",
	                             "Agent" => "unknown") ;
	
		/**
		 * 
		 */
		public function __construct(){
			
			$browsers = array("firefox", "msie", "opera", "chrome", "safari",
	                            "mozilla", "seamonkey",    "konqueror", "netscape",
	                            "gecko", "navigator", "mosaic", "lynx", "amaya",
	                            "omniweb", "avant", "camino", "flock", "aol");

			$this->Agent = strtolower($_SERVER['HTTP_USER_AGENT']);

			foreach($browsers as $browser){
	
				if(preg_match("#($browser)[/ ]?([0-9.]*)#", $this->Agent, $match)){
				
					$this->Name = $match[1] ;
					$this->Version = $match[2] ;
					break ;
				
				}//fin if
	
			}//fin foreach
	
		}//fin __construct
	
	
		public function __get($name){
	
			if(!array_key_exists($name, $this->props)){
	
				die("No such property or function $name");
	
			}//fin if
	
			return $this->props[$name];
	
		}//fin __get
	
	
		/**
		 * 
		 */
		public function __set($name, $val){
	
			if(!array_key_exists($name, $this->props)){
	
	            SimpleError("No such property or function.", "Failed to set $name", $this->props);
	            die();
	
			}//fin if
	
			$this->props[$name] = $val;
	
		}//fin __set
	
	}//fin BROWSER