<?php

	class XML_READER{

		private $xml = null;
		public $array = array();

		/**
		 * 
		 */
		public function __construct($xml_file){
				
			if(file_exists($xml_file)){

				$this->xml = simplexml_load_file($xml_file);  

			}else{

				throw new Exception('XML file doesn\'t exist');

			}//fin else

		}//fin __construct


		/**
		 * 
		 */
		public function parse_xml($element = null){

			$element = ($element == null) ? $this->xml : $element;
			$arr = ($arr == null) ? $this->array : $arr;

			foreach($element as $item => $val){
			
				if(sizeof($val) > 0){
			
					echo '<p><h2><b>' . $item . '</b></h2></p>';
					
					$this->parse_xml($val, &$arr[$item][]);

				}else{

					$arr[$item]['val'] = (string)$val;
					echo '<p><h1><b>' . $item . '</b></h1>: ' . $val . '['.sizeof($val).']</p>';

				}//fin else

			}//fin foreach

		}//fin parse_xml


		public function real_parser($element = null, $arr = array()){

			if(!is_array($arr)){

				$arr = array();

			}//fin if

			$element = ($element == null) ? $this->xml : $element;

			foreach($element as $item => $val){

				$arr[$item] = array();
				//array_push($arr, array($item));
				if(sizeof($val) > 0){
					
					$l = sizeof($val);
echo $item;
$this->dump($val);
					
					$arr[$item]['item'][] = $this->real_parser($val);


					//$this->real_parser($val);

				}else{

					if(isset($item['@attributes'])){

						foreach($val->attributes() as $a => $b){
								
							//array_push($arr[$item], array('attr' => array($a => (string)$b)));
							$arr[$item]['attr'][$a] = (string)$b;

						}//fin foreach

					}//fin if

					//array_push($arr[$item], array('val' => (string)$val[0]));
					$arr[$item]['val'] = (string)$val[0];

				}//fin else

			}//fin foreach

			return $arr;

echo 'a ver...';
//$this->dump($this->array);			

		}


		private function dump($item){
				echo '<pre>';
				var_dump($item);
				echo '</pre>';
		}

	}//fin XML_READER
