<?php
class JsonApi{
	protected $params= array();
	public function call($key='api'){
		if(!empty($_GET['api']))	return;
		echo json_encode($this->params);
		exit();
	}

	public function set($key,$val){
		$this->params[$key]	= $val;
	}

}
