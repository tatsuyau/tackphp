<?php
class Controller{
	protected $Model;

	protected $Request;
	protected $ArrayUtil;
	protected $JsonApi;
	public function __construct(){
		$this->Model	= new Model();
		
		$this->Request	= new Request();
		$this->ArrayUtil= new ArrayUtil();
		$this->JsonApi	= new JsonApi();
	}

	/*
	* Transaction
	*/
	protected function begin(){
		$this->Model->beginTransaction();
	}

	protected function commit(){
		$this->Model->commit();
	}

	protected function rollback(){
		$this->Model->rollback();
	}
	protected function redirect($url){
		header('Loaction: ' . $url);
		exit();
	}
}
