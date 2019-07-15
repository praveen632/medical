<?php
class Expired_Medicine{
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
             WHERE ps.stock_status = '-1'
             AND ps.type = 'ST'
             ORDER BY ps.expire_date DESC limit $start_limit,".PAGE_SIZE;
             $results = $this->db->query($SQL);

       }else{
           $results = $this->db->where(['stock_status'=>'-1'])->order_by('id', 'DESC')->get($this->table, $select);
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
                     WHERE ps.stock_status = '-1'
                     AND ps.type = 'ST'
                     AND pr.name like '%$search_value%'
                     ORDER BY ps.expire_date DESC limit $start_limit,".PAGE_SIZE;
                //$SQL="SELECT *FROM $this->table2 WHERE created_at between '2017-07-18' AND '2017-07-19'";
                $results = $this->db->query($SQL);

              }
              else{
               $results = $this->db->where(['1'=>'-1'])->_like(['name'=>$search_value])->order_by('id', 'DESC')->get($this->table1, $select);
              }
                if($results){
                    return $results;
                }
                return false;
            }

     public function getNotifications(){            
           $cur_date = date('Y-m-d');
                  $date = explode('-',$cur_date);
                  $date_comp = $date[0];
                  $date_comp .= '-'.'0'.$date[1]-1;
                  $date_comp .= '-'.$date[2];

            $SQL = "SELECT ps.*, pr.name as product
             FROM $this->table ps
             INNER JOIN $this->table1 pr
             ON ps.product_id=pr.id
             WHERE ps.stock_status = '1'
             AND ps.type = 'ST' AND ps.expire_date BETWEEN '$cur_date' AND '$date_comp'
             ORDER BY ps.expire_date ASC limit 10 ";
             $results = $this->db->query($SQL);
             if($results){
                return $results;
            }
            return false;
     }

     public function getSortstock(){
        $stock = SHOTNOTIFICATION;
       $SQL = "SELECT ps.*, pr.name as product
             FROM $this->table ps
             INNER JOIN $this->table1 pr
             ON ps.product_id=pr.id
             WHERE ps.rest_stock < $stock
             AND ps.type = 'ST' 
             ORDER BY ps.id ASC limit 10 ";
             $results = $this->db->query($SQL);
             if($results){
                return $results;
            }
            return false;
     }
 }
?>