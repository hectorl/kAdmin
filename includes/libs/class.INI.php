<?php
	/**
	 * Clase para mantenimiento de archivos .ini
	 * 
	 * @author		Héctor Laura
	 */
	class INI{


		/**
		 * Ruta completa al archivo .ini
		 */
		private $_file = null;


		/**
		 * 
		 */
		public function __construct($file){

			$this->_file = $file;

		}//fin __construct


		/**
		 * Crea un archivo .ini con los datos dados
		 * 
		 * @param		$data		Array asociativo con los parametros
		 * @return	$resp		Valor bool: true = correcto | false = incorrecto
		 */
		public function create_ini($data){

			$content  = ';Created on '. date("d/m/Y") . ' ' . date("H:i:s") . "\n";

			$fp = fopen($this->_file, "w");

			foreach($data as $key => $val){

				if(is_array($val)){

					$content .= '[' . $key . ']' . "\n";

					foreach($val as $key2 => $val2){

						$content .= $key2 . '=' . $val2 . "\n";

					}//fin foreach

				}else{
					$content .= $key . '=' . $val . "\n";
				}//fin else

			}//fin foreach

			if(!fwrite($fp, $content)){
				$resp = false;
			}else{
				$resp = true;
			}//fin else

			fclose($fp);

			chmod($this->_file, 0744);

			return $resp;

		}//fin create_ini_file


		/**
		 * Devuelve el archvivo .ini como un array
		 * 
		 * @param		$sections		Valor bool que indica si se devuelven o no secciones
		 */
		public function get_ini($sections = true){

			return parse_ini_file($this->_file, $sections);

		}//fin get_ini_file

	}//fin INI
