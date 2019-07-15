<?php
	class Mysql{
		static private $link = null;
		static private $info = array(
			'last_query' => null,
			'num_rows' => null,
			'insert_id' => null
		);
		static private $connection_info = array();
		static private $where;
		static private $limit;
		static private $start;
		static private $last_limit;
		static private $order;		
		static private $like;		
		static private $in;		
		
		function __construct(){
			self::$connection_info = array('host' => DB_HOST, 'user' => DB_USER, 'pass' => DB_PASS, 'db' => DB_NAME);
		}		
		
		function __destruct(){
			if(is_resource(self::$link)) _close(self::$link);
		}		
		
		/**
		 * Setter methodf
		 */		
		static private function set($field, $value){
			self::$info[$field] = $value;
		}		
		
		/**
		 * Getter methods
		 */		
		public function last_query(){
			return self::$info['last_query'];
		}		
		
		public function num_rows(){
			return self::$info['num_rows'];
		}		
		
		public function insert_id(){
			return self::$info['insert_id'];
		}		
		
		/**
		 * Create or return a connection to the MySQL server.
		 */		
		static private function connection(){
			if(!is_resource(self::$link) || empty(self::$link)){
				if(($link = mysqli_connect(self::$connection_info['host'], self::$connection_info['user'], self::$connection_info['pass'])) && mysqli_select_db($link,self::$connection_info['db'])){
					self::$link = $link;
					mysqli_set_charset($link,'utf8');
				}else{
					throw new Exception('Could not connect to MySQL database.');
				}
			}
			return self::$link;
		}		
		
		/**
		 * MySQL Where methods
		 */		
		static private function __where($info, $type = 'AND'){
			$link = self::connection();
			$where = self::$where;
			foreach($info as $row => $value){
				if(empty($where)){
					$where = sprintf("WHERE %s='%s'", $row, mysqli_real_escape_string(self::$link,$value));
				}else{
					$where .= sprintf(" %s %s='%s'", $type, $row, mysqli_real_escape_string(self::$link,$value));
				}
			}
			self::$where = $where;
		}

		public function where($field, $equal = null){
			if(is_array($field)){
				self::__where($field, 'AND');
			}else{
				self::__where(array($field => $equal), 'AND');
			}
			return $this;
		}
				
		public function and_where($field, $equal = null){
			return $this->where($field, $equal);
		}	

		public function or_where($field, $equal = null){
			if(is_array($field)){
				self::__where($field, 'OR');
			}else{
				self::__where(array($field => $equal), 'or');
			}
			return $this;
		}
		
		/**
		 * MySQL limit method
		 */		
		public function limit($limit,$start=0){
			self::$limit = 'LIMIT '.$start.','.$limit;
			return $this;
		}	

		/**
		 * MySQL limit method
		 */		
		public function _limit($start, $limit){
			self::$limit = 'LIMIT '.$start.','.$limit;
			return $this;
		}


		/**
		 * MySQL like method
		 */		
		public function _like($data){
			$like='';
			foreach($data as $field => $value){
				$like .= " AND ".sprintf("%s LIKE '%s", $field, $value)."%'";
			}
			self::$like = $like;
			return $this;
		}

		/**
		 * MySQL in method
		 */		
		public function in($data){
			$in='';
			foreach($data as $field => $value){
				$value = (empty($value) ? "''" : $value);
				$in .= " AND ".sprintf("%s IN (%s)", $field, $value);
			}
			self::$in = $in;
			return $this;
		}		

		/**
		 * MySQL Order By method
		 */		
		public function order_by($by, $order_type = 'DESC'){
			$order = self::$order;
			if(is_array($by)){
				foreach($by as $field => $type){
					if(is_int($field) && !preg_match('/(DESC|desc|ASC|asc)/', $type)){
						$field = $type;
						$type = $order_type;
					}
					if(empty($order)){
						$order = sprintf("ORDER BY `%s` %s", $field, $type);
					}else{
						$order .= sprintf(", `%s` %s", $field, $type);
					}
				}
			}else{
				if(empty($order)){
					$order = sprintf("ORDER BY `%s` %s", $by, $order_type);
				}else{
					$order .= sprintf(", `%s` %s", $by, $order_type);
				}
			}
			self::$order = $order;
			return $this;
		}		
		
		/**
		 * MySQL query helper
		 */		
		static private function extra(){
			$extra = '';
			if(!empty(self::$where)) $extra .= ' '.self::$where;
			if(!empty(self::$in)) $extra .= ' '.self::$in;
			if(!empty(self::$like)) $extra .= ' '.self::$like;
			if(!empty(self::$order)) $extra .= ' '.self::$order;
			if(!empty(self::$limit)) $extra .= ' '.self::$limit;
			// cleanup
			self::$where = null;
			self::$in = null;
			self::$like = null;
			self::$order = null;
			self::$limit = null;
			return $extra;
		}		
		
		/**
		 * MySQL Query methods
		 */		
		public function query($qry){
			$link = self::connection();
			self::set('last_query', $qry);
			$result = mysqli_query(self::$link,$qry);
			if(is_resource($result)){
				self::set('num_rows', mysqli_num_rows($result));
			 }
		     $data = array();
			 while($row = mysqli_fetch_assoc($result)){
			    	$data[] = $row;
			  }
			  mysqli_free_result($result);
			  return $data;
		}

			public function querys($qry){
			$link = self::connection();
			self::set('last_query', $qry);
			$result = mysqli_query(self::$link,$qry);
			if(is_resource($result)){
				self::set('num_rows', mysqli_num_rows($result));
			 }
		     $data = array();
			 
		}
			
			
					
			
		public function get($table, $select = '*'){
			//echo $table ;
			//echo $select;
			$link = self::connection();
			if(is_array($select)){
				$cols = '';
				foreach($select as $col){
					$cols .= "`{$col}`,";
				}
				$select = substr($cols, 0, -1);
			} 
			$sql = sprintf("SELECT %s FROM %s%s", $select, $table, self::extra());//echo $sql;exit;
			self::set('last_query', $sql);
			if(!($result = mysqli_query(self::$link,$sql))){ 
				throw new Exception('Error executing MySQL query: '.$sql.'. MySQL error '.mysqli_errno(self::$link).': '.mysqli_error(self::$link));
				$data = false;
			}elseif(mysqli_num_rows($result)){  
				$num_rows = mysqli_num_rows($result);
				self::set('num_rows', $num_rows);
				if($num_rows === 0){
					$data = false;
				}
				else{ 
					$data = array();
					while($row = mysqli_fetch_assoc($result)){
						$data[] = $row;
					}
				}
			}else{ 
				$data = false;
			}
                        
			mysqli_free_result($result);
			return $data;
		}
		
		public function insert($table, $data){
			$link = self::connection();
			$fields = '';
			$values = '';
			foreach($data as $col => $value){
				$fields .= sprintf("`%s`,", $col);
				$values .= sprintf("'%s',", mysqli_real_escape_string(self::$link, $value));
			}
			$fields = substr($fields, 0, -1);
			$values = substr($values, 0, -1);
			$sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $table, $fields, $values);
			self::set('last_query', $sql);
			if(!mysqli_query(self::$link,$sql)){
				throw new Exception('Error executing MySQL query: '.$sql.'. MySQL error '.mysqli_errno(self::$link).': '.mysqli_error(self::$link));
			}else{
				self::set('insert_id', mysqli_insert_id(self::$link));
				return mysqli_insert_id(self::$link);
			}
		}		
		
		public function update($table, $info){ 
			if(empty(self::$where)){
				throw new Exception("Where is not set. Can't update whole table.");
			}else{
				$link = self::connection();
				$update = '';
				foreach($info as $col => $value){
					$update .= sprintf("`%s`='%s', ", $col, mysqli_real_escape_string(self::$link, $value));
				}
				$update = substr($update, 0, -2);
					$sql = sprintf("UPDATE %s SET %s%s", $table, $update, self::extra());
				self::set('last_query', $sql);
				if(!mysqli_query(self::$link,$sql)){
					throw new Exception('Error executing MySQL query: '.$sql.'. MySQL error '.mysqli_errno(self::$link).': '.mysqli_error(self::$link));
				}else{
					return true;
				}
			}
		}		
		
		public function delete($table){
			if(empty(self::$where)){
				throw new Exception("Where is not set. Can't delete whole table.");
			}else{
				$link =self::connection();
				$sql = sprintf("DELETE FROM %s%s", $table, self::extra());
				self::set('last_query', $sql);
				if(!mysqli_query(self::$link,$sql)){
					throw new Exception('Error executing MySQL query: '.$sql.'. MySQL error '.mysqli_errno(self::$link).': '.mysqli_error(self::$link));
				}else{
					return true;
				}
			}
		}	
	}