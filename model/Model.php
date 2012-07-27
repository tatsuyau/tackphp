<?php
class Model{
        protected $db;
	protected $name = 'model';
        
	public function __construct(){
                $this->db = new database();
        }

        //条件に合致したレコードを複数取得
        public function getList($params=null){
                $sql    = $this->_createSelectSql($params);
                $this->db->execQuery($sql,$params);
                $res    = $this->db->fetchAll();
                return $res ? $res : array();
        }

        //条件に合致したレコードを1件取得
        public function getData($params=null){
                $sql    = $this->_createSelectSql($params);
                $this->db->execQuery($sql,$params);
                $res    = $this->db->fetch();
                return $res ? $res : array();
        }

        //レコードを1件追加
        public function addData($params){
                $sql    = $this->_createInsertSql($params);
                return $this->db->execQuery($sql,$params);
        }

        //レコードを更新
        public function setData($updates,$conditions){
                $sql    = $this->_createUpdateSql($updates,$conditions);
                $params = $updates + $conditions;
                return $this->db->execQuery($sql,$params);
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

        protected function _createInsertSql($params){
                $sql    = 'INSERT INTO ' . $this->name . ' ';
                $sql    .= ' ( ';
                $i      = 0;
                foreach($params as $key => $val){
                        if($i){
                                $sql    .= ' , ';
                        }
                        $sql    .= $key;
                        $i++;
                }
                $sql    .= ' ) VALUES( ';
                $i      = 0;
                foreach($params as $key => $val){
                        if($i){
                                $sql    .= ' , ';
                        }
                        $sql    .= ' :' . $key;
                        $i++;
                }
                $sql    .= ') ';
                return $sql;
        }

        protected function _createUpdateSql($updates,$conditions){
                $sql    = 'UPDATE ' . $this->name .  ' ';
                $sql    .= $this->__createUpdates($updates);
                $sql    .= $this->__createConditions($conditions);
                return $sql;
        }
        protected function _createSelectSql($params){
                $sql    = 'SELECT * FROM ' . $this->name . ' ';
                $sql    .= $this->__createConditions($params);
                return $sql;
        }

        private function __createUpdates($updates){
                $sql    = ' SET ';
                $i      = 0;
                foreach($updates as $key => $val){
                        if($i){
                                $sql    .= ' , ';
                        }
                        $sql    .= $key . ' = :' .$key ;
                        $i++;
                }
                return $sql;
        }

        private function __createConditions($params){
                $sql    = '';
                if(!$params)    return $params;
                $i      = 0;
                foreach($params as $key => $val){
                        if(!$i){
                                $sql    .= ' WHERE ';
                        }else{
                                $sql    .= ' AND ';
                        }
                        $sql    .= $key . ' = :' . $key;
                        $i++;
                }
                return $sql;

        }

}
