<?php
class Pager{
	public $from	= 0;
	public $offset	= 20;
	public $current	= 1;
	public $next	= 2;
	public $previous= 0;

	public function setPager($offset,$page){
		$this->offset	= $offset;
		$this->current	= $this->__checkCurrentPage($page);
		$this->next	= $this->current + 1;
		$this->previous	= $this->current - 1;
		$this->from	= ($this->current - 1) * $this->offset;
	}

	private function __checkCurrentPage($page){
		if(!is_numeric($page)){
			return 1;
		}
		if($page < 1){
			return 1;
		}
		return $page;
	}
}
