<?php
class TodoController extends Controller{
	public function __construct(){
		$this->todo = new Todo();
	}

	public function index(){
		if(isset($this->_request['title'])){
			$data = $this->todo->searchTodo($this->_request);
			return require_once($this->layout);
		}
		$data = $this->todo->getTodo();

		return require_once($this->layout);
	}

	public function add(){
		$this->todo->setTodo($this->_request);
		header('Location: ./todo');
		exit();
	}

	public function update(){
		$this->todo->updateTodo($this->_request);
		
		header('Location: ./todo');
		exit();
	}
}
