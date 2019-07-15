<?php
class company{
	public $db ;
    private $table;
	public  function __construct() {
        $this->db = new Mysql();
        $this->table = COMPANY;
    }
     public function getCompany($select = '*'){
           $results = $this->db->get($this->table, $select);
                if($results){
                    return $results;
                }
                return false;
            }

    public function getcheak($name,$select = '*'){
            $results = $this->db->where(['name'=>$name])->get($this->table, $select);
                 if($results){
                     return $results;
                    }
                 return false;
            }

    public function getcheak_id($id, $name, $select = '*'){
        $data['name'] = $name;
        $data['id'] = $id;
            $results = $this->db->where($data)->get($this->table, $select);
                 if($results){
                      return $results;
                    }
                  return false;
            }

    public function getedit($id){
       	$results = $this->db->where(['id'=>$id])->get(COMPANY);
        if($results){
            return $results;
        }
            return false;
    }

    public function company_update($id, $data){
       $result = $this->db->where(array('id'=>$id))->update(COMPANY, $data);
       if($result){
            return $result;
        }
            return false;
    }

    public function company_delete($id){
    	 $result = $this->db->where(array('id'=>$id))->delete(COMPANY);
    	 if($result){
            return $result;
           }
            return false;
    }

    public function addcompany($data){
         $result = $this->db->insert($this->table, $data);
          if($result){
            return $result;
           }
            return false;
    }

    public function pagefind($start_limit,$last_limit,$select="*"){
       $results = $this->db->where(['1'=>'1'])->order_by('id', 'ASC')->_limit($start_limit, $last_limit)->get($this->table, $select);
        if($results)
            return $results;
        return false;
    }

     public function getTax($select = '*', $start_limit=-1){
        if($start_limit>-1){
           $results = $this->db->where(['1'=>'1'])->order_by('id', 'DESC')->_limit($start_limit, PAGE_SIZE)->get($this->table, $select);
         }
         else
         {
             $results = $this->db->where(['1'=>'1'])->order_by('id', 'DESC')->get($this->table, $select);
         }
        if($results)
            return $results;

        return false;
    }

    public function getTaxBySearch($search_value, $select = '*',$start_limit=-1){
        if($start_limit>-1){
             $results = $this->db->where(['1'=>'1'])->_like(['name'=>$search_value])->order_by('id', 'DESC')->_limit($start_limit, PAGE_SIZE)->get($this->table, $select);
         }
         else
         {
              $results = $this->db->where(['1'=>'1'])->_like(['name'=>$search_value])->order_by('id', 'DESC')->get($this->table, $select);  
         }
        if($results)
            return $results;

        return false;
    }

    
}
?>