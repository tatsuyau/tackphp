<?php
class DefaultController extends Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$helloworld = 'Well done! tackphp is installed.';
		require_once($this->layout);
	}

	public function error($errorBody){
		require_once($this->layout);
	}
}
