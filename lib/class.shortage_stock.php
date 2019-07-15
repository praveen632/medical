<?php
class Shortage_Stock{
	public $db ;
    private $table;
	public  function __construct() {
        $this->db = new Mysql();
        $this->table = MEDI_SALES;
        $this->table1 = PRODUCT;
    }

    public function getTax($select = '*', $start_limit=-1){
      
       if($start_limit>-1){
        
            $SQL = "SELECT ps.*, pr.name as product
             FROM $this->table ps
             INNER JOIN $this->table1 pr
             ON ps.product_id=pr.id
             WHERE ps.rest_stock = '0'
             ORDER BY ps.expire_date ASC limit $start_limit,".PAGE_SIZE;
             $results = $this->db->query($SQL);

       }else{
           $results = $this->db->where(['rest_stock'=>'0'])->order_by('id', 'ASC')->get($this->table, $select);
          }
            if($results){
                return $results;
            }
            return false;
    }

    public function getTaxBySearch($search_value, $select = '*', $start_limit=-1){
             if($start_limit>-1){                  
                $SQL="SELECT ps.*, pr.name as product
                     FROM $this->table ps
                     INNER JOIN $this->table1 pr
                     ON ps.product_id=pr.id
                     WHERE ps.rest_stock = '0'
                     AND pr.name like '%$search_value%'
                     ORDER BY ps.expire_date DESC limit $start_limit,".PAGE_SIZE;
                //$SQL="SELECT *FROM $this->table2 WHERE created_at between '2017-07-18' AND '2017-07-19'";
                $results = $this->db->query($SQL);

              }
              else{
               $results = $this->db->where(['1'=>'1'])->_like(['name'=>$search_value])->order_by('id', 'DESC')->get($this->table1, $select);
              }
                if($results){
                    return $results;
                }
                return false;
            }
        }
?>