<?php
class Product_type{
	public $db ;
    private $table;
	public  function __construct() {
        $this->db = new Mysql();
        $this->table = PRODUCTTYPE;
        $this->table1 = PRODUCTUNIFORM;
    }
     public function getProduct($select = '*'){
                 $results = $this->db->order_by('id', 'ASC')->get(PRODUCTUNIFORM, $select); 
                 $arr_uniform = array();
                 foreach ($results as $data) {                    
                      $arr_uniform[$data['id']] =  $data['name'];               
                  }
                  
                 $results = $this->db->order_by('id', 'ASC')->get(PRODUCTTYPE, $select); 
                 foreach ($results as $k=>$data) {
                    $uniformname='';
                    foreach (explode(',', $data['product_uniform']) as $val) {
                        $uniformname .= (isset($arr_uniform[$val]) ? $arr_uniform[$val] : '').', ';
                    }
                    $results[$k]['product_uniform'] = trim(substr(trim($uniformname), 0, -1));
                    $uniformname = '';
                 }
                 if($results){
                    return $results;
                }
                return false;
            }

            public function getuniform($select = '*'){
                $results = $this->db->order_by('id', 'ASC')->get(PRODUCTUNIFORM, $select);             
                if($results){
                    return $results;
                }
                return false;
            }

            public function addproduct($data){
                  $result = $this->db->insert($this->table, $data);

                  if($result){
                    return $result;
                   }
                    return false;
                }

            public function productType_delete($id){
                 $result = $this->db->where(array('id'=>$id))->delete(PRODUCTTYPE);
                 if($result){
                    return $result;
                   }
                    return false;
             }

            public function getedit($id){
           //print_r($id);die;

                $results = $this->db->where(['id'=>$id])->get(PRODUCTTYPE);
                      $ids = $results[0]['product_uniform'];
                      $id = explode(',', $ids);
                      $length = count($id);
                      for ($i = 0; $i < $length; $i++) {
                            $result[$i] = $this->db->where(['id'=>$id[$i]])->get(PRODUCTUNIFORM);              
                        }
                        foreach ($result as $data) {                    
                             $uniformname[] = $data[0]['id'];                   
                        }
                        $output = implode( ",", $uniformname);
                        $results[0]['uniform_name']=$output;
                        unset($uniformname);                       
                if($results){
                    return $results;
                }
                    return false;
             } 


             public function get_uni($select = '*'){
                //print_r($id);die;
                 $result = $this->db->order_by('id', 'ASC')->get(PRODUCTUNIFORM, $select);
                return $result;
             }

             public function productType_Update($ids, $data){
                   $result = $this->db->where(array('id'=>$ids))->update(PRODUCTTYPE, $data);
                   if($result){
                        return $result;
                    }
                        return false;
                }


        public function getTax($select = '*', $start_limit=-1){
            if($start_limit>-1){
                 $results = $this->db->order_by('id', 'ASC')->get(PRODUCTUNIFORM, $select); 
                 $arr_uniform = array();
                 foreach ($results as $data) {                    
                      $arr_uniform[$data['id']] =  $data['name'];               
                  }
                  
                 $results = $this->db->where(['1'=>'1'])->order_by('id', 'DESC')->_limit($start_limit, PAGE_SIZE)->get(PRODUCTTYPE, $select); 
                 foreach ($results as $k=>$data) {
                    $uniformname='';
                    foreach (explode(',', $data['product_uniform']) as $val) {
                        $uniformname .= (isset($arr_uniform[$val]) ? $arr_uniform[$val] : '').', ';
                    }
                    $results[$k]['product_uniform'] = trim(substr(trim($uniformname), 0, -1));
                    $uniformname = '';
                 }
                
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
                 //$results = $this->db->where(['1'=>'1'])->_like(['name'=>$search_value])->order_by('id', 'DESC')->_limit($start_limit, PAGE_SIZE)->get($this->table, $select);

                  $results = $this->db->order_by('id', 'ASC')->get(PRODUCTUNIFORM, $select); 
                 $arr_uniform = array();
                 foreach ($results as $data) {                    
                      $arr_uniform[$data['id']] =  $data['name'];               
                  }
                  
                 $results = $this->db->where(['1'=>'1'])->_like(['name'=>$search_value])->order_by('id', 'ASC')->_limit($start_limit, PAGE_SIZE)->get(PRODUCTTYPE, $select); 
                 foreach ($results as $k=>$data) {
                    $uniformname='';
                    foreach (explode(',', $data['product_uniform']) as $val) {
                        $uniformname .= (isset($arr_uniform[$val]) ? $arr_uniform[$val] : '').', ';
                    }
                    $results[$k]['product_uniform'] = trim(substr(trim($uniformname), 0, -1));
                    $uniformname = '';
                 }
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