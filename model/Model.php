<?php
class Model{
        protected $db;
        public function __construct(){
                $this->db = new database();
        }

        public function beginTransaction(){
                $sql = 'SET AUTOCOMMIT = 0 ';
                $this->db->execQuery($sql);

                $sql = 'BEGIN ';
                $this->db->execQuery($sql);
        }

        public function commit(){
                $sql = 'COMMIT ';
                $this->db->execQuery($sql);
        }

        public function rollback(){
                $sql = 'ROLLBACK ';
                $this->db->execQuery($sql);
        }
}
