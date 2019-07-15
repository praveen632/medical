<?php
class Taxlist{

    public $db ;
    private $table;
    
    
    public  function __construct() {
        $this->db = new Mysql();
        $this->table = MEDI_TAX_LIST;
       
    }

    public function get($select = '*'){
        $results = $this->db->get($this->table, $select);
        if($results)
            return $results;
        return false;
    }

    public function save($data){
        $result = $this->db->insert($this->table, $data);
        return $result;
    }

     public function getedit($id, $select = '*'){
        $results = $this->db->where(['id'=>$id])->get($this->table, $select);
       if($results)
            return $results;
        return false;
    }

    public function taxlistupdate($id, $data){
       $result = $this->db->where(['id'=>$id])->update($this->table, $data);
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

    public function delete($id){
         $result = $this->db->where(['id'=>$id])->delete($this->table);
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