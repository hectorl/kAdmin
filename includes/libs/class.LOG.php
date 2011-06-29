<?php
	/**
	 * Guarda los logs de errores en el archivo dado
	 * 
	 * @author	Héctor Laura
	 * @package	k!Admin
	 * @version	0.1
	 */


	class LOG{

		const LOG_FILE = LOG_FILE;


		/**
		 * Función constructora
		 */
		public function __construct($type = 'Unknown', $plugin = '?', $msg){

			$this->type = $type;
			$this->plugin = $plugin;
			$this->msg = $msg;
			$this->id_user = $this->get_id_user();
			$this->event_date = date('Y-m-d H:i');
			$this->ip = $this->get_ip();

			$this->write_log_line();

		}//fin __construct


		/**
		 * Saca el id del usuario
		 */
		private function get_id_user(){

			return (isset($_SESSION['user']['id'])) ? $_SESSION['user']['id'] : 'No logged'; 

		}//fin get_id_user


		/**
		 * Saca la IP del usuario
		 * 
		 * @link	http://snipplr.com/view.php?codeview&id=46791	From snipplr
		 */
		private function get_ip(){

			if(!empty($_SERVER['HTTP_CLIENT_IP'])){

				$ip = $_SERVER['HTTP_CLIENT_IP'];

			}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){

				$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];

			}else{

				$ip = $_SERVER['REMOTE_ADDR'];

			}//fin else

			return $ip;

		}//fin get_ip


		/**
		 * Escribe una linea en el log
		 */
		private function write_log_line(){

			$fp = fopen(self::LOG_FILE, "a");

			$line = array($this->event_date, $this->type, $this->plugin, $this->msg, $this->id_user, $this->ip);

			if(!fwrite($fp, implode(chr(9), $line) . chr(10))){

				$resp = false;

			}else{

				$resp = true;

			}//fin else

			fclose($fp);

		}//fin write_log_line

	}//fin LOG
