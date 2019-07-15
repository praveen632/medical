<?php
	class User{
			//echo "hi";
			//$table = CMS_PRODUCT;
            public $db ;
                public  function __construct() {
                $this->db = new Mysql();
				$this->table = CMS_USERS;
				$this->table1 = MEDI_SALES;
								
            }

			public function login($pass, $username){
				$this->db->where(array('username'=>$username,'password'=>md5($pass)));
                $userData = $this->db->get(CMS_USERS);
            if ($userData)   
            {				  
                return $userData;  
            }  
            else  
            {  
                return FALSE;  
            }   
			}

			public function signup($username, $data){
				$result = $this->db->where(['username'=>$username])->get(CMS_USERS);
				if($result){
                  return false;
				}else{
                  $result = $this->db->insert($this->table, $data);
                  	$userData = $this->db->where(['username'=>$username])->get(CMS_USERS);
                   return $userData;
				}             
		      
			}
			
			public function update($id, $data){ 
			 $result = $this->db->where(['id'=>$id])->update($this->table,$data);
		       if($result){
		            return $result;
		        }
		            return false;
	}


public function update_expiremedicine(){
    $SQL = "UPDATE $this->table1 SET stock_status = '-1' WHERE expire_date < CURDATE() AND stock_status = '1' AND type='ST' ";
	 $results = $this->db->querys($SQL);
       if($results){
            return $results;
        }
            return false;
}

public function getUser($id, $select = "*"){
	$results = $this->db->where(['id'=>$id])->get($this->table, $select);
	if($results){
		return $results;
	}
	return false;
}

public function addUser($data, $condition = '') {
	if(!empty($condition)){
            return $this->db->where($condition)->update($this->table, $data);
                  }else{
             return $this->db->insert($this->table, $data);
          }
				
	}
}
?>
