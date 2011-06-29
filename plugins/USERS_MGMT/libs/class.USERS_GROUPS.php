<?php

	class USERS_GROUPS extends KADMIN_C{

		/**
		 * Groups table
		 */
		private $_gt = null;
		/**
		 * Nombre del campo identificador
		 */
		private $_id = null;
		/**
		 * Identificador de la base de datos
		 */
		private $_bdLink = null;


		/**
		 * 
		 */
		public function __construct($table, $id, $bdLink){

			$this->_gt = $table;			
			$this->_id = $id;
			$this->_bdLink = $bdLink;

		}//fin __construct


		/**
		 * Inserta el usuario en la base de datos
		 * 
		 * @param		$group			array con los datos del grupo
		 * 
		 */
		public function set_group($group, $id = ''){

			$tables = array($this->_gt);

			if(strlen($id) == 0){

				$this->insert($this->_bdLink);
				$this->fields($group);				

			}else{

				$this->update($this->_bdLink);
				$this->fields($group);
				$this->where($this->_id . '="' .  mysql_real_escape_string($id, $this->_bdLink) . '"', '', '', false);

			}//fin else

			$this->tables($tables);
			$this->execute();

		}//fin set_group

	}//fin USERS_GROUPS
