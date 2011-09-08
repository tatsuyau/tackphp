<?php
class DefaultController extends Controller{

	public function index(){
		$var = 'this is test page.';
		require_once($this->layout);
	}

	public function error($errorBody){
		require_once($this->layout);
	}
}
