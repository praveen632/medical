<?php
class productuniform{
	public $db ;
    private $table;
	public  function __construct() {
        $this->db = new Mysql();
        $this->table = PRODUCTUNIFORM;
    }
     public function getProductuniform($select = '*'){
              $results = $this->db->order_by('id', 'ASC')->get(PRODUCTUNIFORM, $select);
              
                if($results){
                    return $results;
                }
                return false;
            }

    public function getedit($id){
       	$results = $this->db->where(['id'=>$id])->get(PRODUCTUNIFORM);
        if($results){
            return $results;
        }
            return false;
    }

    public function productuniform_update($id, $data){
       $result = $this->db->where(array('id'=>$id))->update(PRODUCTUNIFORM, $data);
       if($result){
            return $result;
        }
            return false;
    }

    public function productuniform_delete($id){
    	 $result = $this->db->where(array('id'=>$id))->delete(PRODUCTUNIFORM);
    	 if($result){
            return $result;
           }
            return false;
    }

    public function addproductuniform($data){
         $result = $this->db->insert($this->table, $data);
          if($result){
            return $result;
           }
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