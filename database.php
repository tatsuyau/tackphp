<?php
class database{
	public $schema = array(
		'default' => array(
			'host' => 'localhost',
			'user' => 'user',
			'password' => 'password',
			'schema' => 'databasename',
			'encoding' => 'utf8'
			),
		'dev' => array(
			),
		);

	public $db_info = array();
	public $isConnect = false;
	public $queryResult = false;

	public function __construct($schemaName = "default"){
		$this->db_info = $this->schema[$schemaName];
		$conn = @mysql_connect($this->db_info['host'],$this->db_info['user'],$this->db_info['password']);
		if($conn && mysql_select_db($this->db_info['schema'])){
			if(mysql_query('SET NAMES ' . $this->db_info['encoding']) !== false){
				$this->isConnect = true;
			}
		}
	}

	public function execQuery($sql,$hashParam = null){
		try{
			if(!empty($hashParam)){
				if(!is_array($hashParam)){
					throw new Exception('hashParam is not array');
				}
				foreach($hashParam as $key => $value){
					if(is_string($value)){
						$value = "'" . $this->escape($value) . "'";
					}
					$sql = preg_replace("/:({$key})/",$value,$sql);
				}
			}
			$result = mysql_query($sql);
			if($result === false){
				throw new Exception('tackphp error: ' . $sql . ' .... result error.');
			}
			return $this->queryResult = $result;
		}catch(Exception $e){
			if(DEBUG_MODE === true){
				echo '<pre>' . $e->getMessage() . "\n";
				var_dump($hashParam);
				echo '</pre>';
			}else{
				return false;
			}
		}
	}

	private function escape($string){
		return mysql_real_escape_string($string);
	}

	public function fetch(){
		$data = array();
		if(!$this->queryResult){
			return false;
		}

		$data = mysql_fetch_array($this->queryResult,MYSQL_ASSOC);
		return $data;
	}
		
	public function fetchAll(){
		$data = array();
		if(!$this->queryResult){
			return false;
		}
		while($row = mysql_fetch_array($this->queryResult,MYSQL_ASSOC)){
			$data[] = $row;
		}
		return $data;
	}
}
