<?php
class Request{
	public function getParams(){
		$params	= array();
		if(!empty($_GET)){
			foreach($_GET as $key => $val){
				$params[$key]	= $val;
			}
		}

		if(!empty($_POST)){
			foreach($_POST as $key => $val){
				$params[$key]	= $val;
			}
		}

		return $params;
	}

	public function getParam($key_name){
		$param	= null;
		$params	= $this->getParams();
		foreach($params as $key => $val){
			if($key == $key_name){
				$param = $val;
				break;
			}
		}
		return $param;
	}

	public function getInt($key_name){
		$param	= $this->getParam($key_name);
		if(!$param)	return 0;
		if(!is_numeric($param))	return 0;
		return $param;
	}
}
