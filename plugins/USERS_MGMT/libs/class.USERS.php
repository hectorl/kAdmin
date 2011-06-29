<?php

	/**
	 * Mantenimiento de usuarios para k!Admin
	 * 
	 * @author	Héctor Laura
	 */

	class USERS extends KADMIN_C{
		
		/**
		 * Users table
		 */
		private $_ut;
		/**
		 * Nombre de la clave del array en la sesión
		 */
		private $_keySession;
		/**
		 * Nombre del campo identificador
		 */
		private $_id;
		/**
		 * Contiene el enlace con la base de datos
		 */
		private $_bdLink;


		/**
		 * 
		 */		
		public function __construct($table, $id, $key = null){

			$this->check_session_life();

			$this->_ut = $table;			
			$this->_id = $id;
			
			if($key != null){

				$this->_keySession = $key;

			}//fin if

		}//fin __construct


		/**
		 * Comprueba el tiempo de vida de la sesión
		 */
		private function check_session_life(){

		     if(!empty($_SESSION['timeout'])){

		         // set session life to current time minus timeout
		         $session_life = time() - $_SESSION['timeout'];
		         // check if your session life is greater than SESSION_EXPIRES minutes
		         if ($session_life > SESSION_EXPIRES){

		             $this->close_session();
		             header("Location:" . URL_KAD);
		             exit();

		         }//fin if

		     }//fin if

     		$_SESSION['timeout'] = time();			

		}//fin check_session_active


		/**
		 * Comprueba si el usuario existe en la base de datos comparando el sh1 de los campos dados con los valores
		 * 
		 * @param		$fields			array asociativo campo => valor
		 * @return	bool				true		=> Hay un usuario con esos datos
		 * 							false	=> No hay un usuario con esos datos
		 */
		public function check_user_exists($fields){

			//Comprobamos si es el superadministrador
			if($fields['user'] == K_USER && $fields['pass'] == K_PASS){

				return array('user' => $fields['user'], 'name' => 'THE SUPER ADMIN', 'access' => 0);

			//Comprobamos si esta en la base de datos
			}else{

				$db = DB::init();
	
				$sqlFields = array();
				$hash = '';
	
				foreach($fields as $key => $value){
	
					$sqlFields[] = $key;
					$hash 	  .= $value;
	
				}//fin foreach
	
				$rows = array();
				$field = array('*');
				$where  = 'SHA1(CONCAT(' . implode(',', $sqlFields) . ')) = "' . sha1($hash) . '"';
	
				$db->select();
				$db->fields($field);
				$db->tables($this->_ut);
				$db->where($where, '', '', false);
				$rows = $db->execute(true);			
	
				return (sizeof($rows) == 1) ? $rows[0] : false;

			}//fin else

		}//fin check_user_exists



		/**
		 * Comprueba si existe un usuario a partir de los datos pasados en el array
		 * 
		 * @param		$fields			array asociativo campo => valor
		 * @return	bool				true		=> Hay un usuario con esos datos
		 * 							false	=> No hay un usuario con esos datos
		 */
		public function check_user_repeated($fields){

			$sqlFields = array();
			$hash = '';

			foreach($fields as $key => $value){

				$sqlFields[] = mysql_real_escape_string($key, $this->_bdLink) . '="' . mysql_real_escape_string($value, $this->_bdLink) . '"';

			}//fin foreach

			$field = array('*');
			$tables = array($this->_ut);
			$where  = array(implode(' AND ', $sqlFields));

			$this->select($this->_bdLink);
			$this->fields($field);
			$this->tables($tables);
			$this->where($where);
			$rows = $this->execute();

			return (sizeof($rows) > 0) ? true : false;			

		}//fin check_user_repeated



		/**
		 * Guarda los valores que queremos en la sesión en la posición indicada
		 * 
		 * @param		$key				nombre de la clave del array en $_SESSION
		 * @param		$user			array con los datos que queremos guardar en la sesión
		 */
		public function set_session($user){			

			$_SESSION[$this->_keySession] = $user;

		}//fin set_session



		/**
		 * Comprueba si existe la sesión
		 * 
		 * @param		$key				Nombre de la clave del array $_SESSION
		 * @return	bool				true		=> La sesión existe
		 * 							false	=> La sesión no existe
		 */
		public function check_session(){			

			return (isset($_SESSION[$this->_keySession])) ? true : false;

		}//fin check_session


		
		/**
		 * Inserta el usuario en la base de datos
		 * 
		 * @param		$user			array con los datos del usuario
		 * 
		 */
		public function set_user($user, $id = ''){		

			foreach($user as $key => $value){

				$user[$key] = stripslashes($value);

			}//fin foreach

			$tables = array($this->_ut);

			if(strlen($id) == 0){

				$this->insert($this->_bdLink);
				$this->fields($user);

			}else{

				$this->update($this->_bdLink);
				$this->fields($user);
				$this->where($this->_id . '="' .  mysql_real_escape_string($id, $this->_bdLink) . '"', '', '', false);

			}//fin else

			$this->tables($tables);

			return $this->execute();

		}//fin set_user



		/**
		 * Saca el listado de todos los usuarios
		 * 
		 * @return	$Ds->rows			array con los datos de los usuarios
		 * 
		 */
		public function get_all_users(){

			$field = array('*');
			$tables = array($this->_ut);

			$this->select($this->_bdLink);
			$this->fields($field);
			$this->tables($tables);

			return $this->execute();			

		}//fin getAllUsers



		/**
		 * Saca la información de un usuario a través de su id
		 * 
		 * @param		$id				identificador del usuario
		 * @return	$row[0]		array con la información del usuario
		 */
		public function get_user($id){

			$field = array('*');
			$tables = array($this->_ut);

			$this->select($this->_bdLink);
			$this->fields($field);
			$this->tables($tables);
			$this->where($this->_id . '="' . mysql_real_escape_string($id, $this->_bdLink) . '"', '', '', false);

			$row = $this->execute();

			return $row[0];

		}//fin get_user


		/**
		 *	Check the password change
		 *
		 * 	@params	$old_pass		Older password
		 * 	@params	$new_pass		New pass which overwrite old pass
		 * 	@params	$re_pass		Same as new pass 
		 * 	@return	int	0 -> Success: 	with password change
		 * 				1 -> Success: 	without password change
		 * 				2 -> Error:	Old pass not inserted but new pass or re pass yes
		 * 				3 -> Error:	Old pass inserted but new pass not equal re pass
		 * 				4 -> Error:	Old pass inserted but new pass or re pass not
		 * 				5 -> Error:	Old pass doesn't match with database
		 */
		public function check_change_pass($old_pass, $new_pass, $re_pass){

			$old_pass = trim($old_pass);
			$new_pass = trim($new_pass);
			$re_pass  = trim($re_pass); 

			if(strlen($old_pass) > 0){

				if($new_pass !== $re_pass){

					return 3; 

				}elseif(strlen($new_pass) == 0 || strlen($re_pass) == 0){

					return 4;

				}else{

					$fields = array('user' => $_SESSION[SESSION_NAME]['user'], 'pass' => sha1($old_pass));

					return ($this->check_user_exists($fields)) ? 0 : 5;

				}//fin else

			}elseif(strlen($new_pass) > 0 || strlen($re_pass) > 0){

				return 2;

			}else{

				return 1;

			}//fin else

		}//fin check_change_pass


		/**
		 *	Close and destroy session
		 */
		public function close_session(){

			unset($_SESSION[$this->_keySession]);
			session_destroy($_SESSION[$this->_keySession]);				

		}//fin close_session

	}//fin USERS