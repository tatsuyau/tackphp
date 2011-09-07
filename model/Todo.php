<?php
class Todo extends Model{
	public function __construct(){
		$this->db = new database();
	}

	public function getTodo(){
		$sql = 'SELECT * FROM todo ORDER BY status ';
		$this->db->execQuery($sql);
		return $this->db->fetchAll();
	}

	public function setTodo($req){
		$sql = 'INSERT INTO todo (title,created) VALUES(:title,:created) ';
		$hashParam = array(
			'title' => $req['title'],
			'created' => date('Y-m-d H:i:s')
			);

		return $this->db->execQuery($sql,$hashParam);
	}

	public function updateTodo($req){
		$sql = 'UPDATE todo SET status = :status WHERE id = :id ';
		$hashParam = array(
			'id' => $req['id'],
			'status' => $req['status']
			);
		return $this->db->execQuery($sql,$hashParam);
	}

	public function searchTodo($req){
		$sql = 'SELECT * FROM todo WHERE title like :title';
		$hashParam = array(
			'title' => '%' . $req['title'] . '%',
			);

		$this->db->execQuery($sql,$hashParam);
		return $this->db->fetchAll();
	}
}
