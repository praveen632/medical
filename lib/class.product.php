<?php
class Product{
	public $db ;
    private $table;
	public  function __construct() {
        $this->db = new Mysql();
        $this->table = PRODUCT;
        $this->table1 = PRODUCTUNIFORM;
        $this->table2 = PRODUCTTYPE;
        $this->table3 = COMPANY;
        $this->table4 = MEDI_TAX_LIST;
    }
     public function getProduct($select = '*', $start_limit=-1){
               if($start_limit>-1){                  
                $SQL="SELECT p.*, c.name as company_name, pt.name as product_type_name, pu.name as product_uniform_name
                      FROM $this->table p
                      INNER JOIN $this->table3 c
                      ON p.company_id=c.id
                      INNER JOIN $this->table2 pt
                      ON p.product_id=pt.id
                      INNER JOIN $this->table1 pu
                      ON p.product_uniform=pu.id
                      ORDER BY p.id DESC limit $start_limit,".PAGE_SIZE;
                //$SQL="SELECT *FROM $this->table2 WHERE created_at between '2017-07-18' AND '2017-07-19'";
                $results = $this->db->query($SQL);
              }
              else{
               $results = $this->db->where(['1'=>'1'])->order_by('id', 'DESC')->get($this->table, $select);
              }
                if($results){
                    return $results;
                }
                return false;
            }

      public function getTaxBySearch($search_value, $select = '*', $start_limit=-1){
             if($start_limit>-1){                  
               $SQL="SELECT p.*, c.name as company_name, pt.name as product_type_name, pu.name as product_uniform_name
                      FROM $this->table p
                      INNER JOIN $this->table3 c
                      ON p.company_id=c.id
                      INNER JOIN $this->table2 pt
                      ON p.product_id=pt.id
                      INNER JOIN $this->table1 pu
                      ON p.product_uniform=pu.id
                      AND p.name like '%$search_value%'
                      ORDER BY p.id DESC limit $start_limit,".PAGE_SIZE;
                //$SQL="SELECT *FROM $this->table2 WHERE created_at between '2017-07-18' AND '2017-07-19'";
                $results = $this->db->query($SQL);

              }
              else{
               $results = $this->db->where(['1'=>'1'])->_like(['name'=>$search_value])->order_by('id', 'DESC')->get($this->table, $select);
              }
                if($results){
                    return $results;
                }
                return false;

      }

      public function get_uni($id){
              $results = $this->db->where(['id'=>$id])->get(PRODUCTUNIFORM);
               if($results){
                    return $results;
                }
                return false;
      } 

      public function get_type($id){
             $results = $this->db->where(['id'=>$id])->get(PRODUCTTYPE);
               if($results){
                    return $results;
                }
                return false;
      }

      public function getedit($id){
        $results = $this->db->where(['id'=>$id])->get(PRODUCT);
        if($results){
            return $results;
        }
            return false;
      }

      public function get_company($select = '*'){
           $results = $this->db->order_by('id', 'ASC')->get(COMPANY, $select);
              //print_r($results);die;              
                if($results){
                    return $results;
                }
                return false;
      }

      public function get_product($select = '*'){
         $results = $this->db->order_by('id', 'ASC')->get(PRODUCTTYPE, $select);                          
            if($results){
                return $results;
            }
            return false;
      }

     public function get_uniform($id){
         $results = $this->db->where(['id'=>$id])->get(PRODUCTTYPE);
         $ids = $results[0]['product_uniform'];
         $id = explode(',', $ids);
         $length = count($id);
         for ($i = 0; $i < $length; $i++) {
                $result[$i] = $this->db->where(['id'=>$id[$i]])->get(PRODUCTUNIFORM);
            }
             foreach ($result as $data) {                    
                 $uniformname[] = $data;                   
            }
            if($uniformname){
                return $uniformname;
            }
            return false;

     }

     public function product_update($id, $data){
         $result = $this->db->where(array('id'=>$id))->update(PRODUCT, $data);
           if($result){
                return $result;
            }
                return false;
     }

     public function get_tax($select = '*'){
         $results = $this->db->order_by('id', 'ASC')->get(MEDI_TAX_LIST, $select);
              //print_r($results);die;              
                if($results){
                    return $results;
                }
                return false;
     }

     public function product_save($data){
         $result = $this->db->insert($this->table, $data);
          if($result){
            return $result;
           }
            return false;
     }

     public function product_delete($id){
         $result = $this->db->where(array('id'=>$id))->delete(PRODUCT);
         if($result){
            return $result;
           }
            return false;
     } 
     public function get_type_product($id, $select = '*') { 
        $results = $this->db->where(['id'=>$id])->get($this->table1, $select);
        if($results){
          return $results;
        }
        return false;
    }   
}