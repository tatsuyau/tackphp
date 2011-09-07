<?php
class SampleController extends Controller{
	public function index(){
		$this->data['var'] = "this is a sample page!";
	}
}
