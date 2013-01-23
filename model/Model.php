<?php
class Model{
        protected $db;

	protected $created  = null;	// 'created'
	protected $modified = null;	// 'modified'
       
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
		$params	= $this->_joinParamDatetimesInsert($params);
                $sql    = $this->_createInsertSql($params);
                return $this->db->execQuery($sql,$params);
        }

        //レコードを更新
        public function setData($updates,$conditions){
		$updates= $this->_joinParamDatetimesUpdate($updates);
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
                $sql    = 'INSERT INTO ' . $this->_getTableName() . ' ';
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
                $sql    = 'UPDATE ' . $this->_getTableName() .  ' ';
                $sql    .= $this->__createUpdates($updates);
                $sql    .= $this->__createConditions($conditions);
                return $sql;
        }
        protected function _createSelectSql($params){
                $sql    = 'SELECT * FROM ' . $this->_getTableName() . ' ';
                $sql    .= $this->__createConditions($params);
                return $sql;
        }

        protected function _getTableName(){
                if(!empty($this->name)) return $this->name;
                $table_name     = '';
                $class_name     = get_class($this);
                preg_match_all("/[A-Z][a-z]+/",$class_name,$matches_list);
                foreach($matches_list[0] as $key => $val){
                        if($key)        $table_name .= '_';
                        $table_name     .= strtolower($val);
                }
                return $table_name;
        }

	protected function _joinParamDatetimesInsert($params){
		if($this->created)	$params[$this->created]	= $this->_setAutoTime();
		if($this->modified)	$params[$this->modified]= $this->_setAutoTime();
		return $params;
	}
	protected function _joinParamDatetimesUpdate($params){
		if($this->modified)	$params[$this->modified]= $this->_setAutoTime();
		return $params;
	}

	protected function _setAutoTime(){
		return date('Y-m-d H:i:s');
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
