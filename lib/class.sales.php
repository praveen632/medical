<?php 

class Sales{

	public $db;
	private $table;

	public function __construct(){
		$this->db = new Mysql();
		$this->table = MEDI_SALES;
		$this->table1 = CUSTOMER_INFO;
	}

	public function getTax($select = '*', $start_limit=-1){        
       if($start_limit>-1){        
          $SQL = "SELECT ps.*, cu.customer_name as customer_name, cu.address as address, cu.mobile_no as mobile
             FROM $this->table ps
             INNER JOIN $this->table1 cu
             ON ps.customer_id=cu.id
             WHERE ps.type = 'SL'
             ORDER BY ps.id DESC limit $start_limit,".PAGE_SIZE;
             $results = $this->db->query($SQL);

       }else{
           $results = $this->db->where(['type'=>'SL'])->order_by('id', 'ASC')->get($this->table, $select);
          }
            if($results){
                return $results;
            }
            return false;
    }

    public function getTaxBySearch($data, $select = '*',$start_limit=-1){   
    	if($data['invoice_nmbr'] != '' ){
    	$search = $data['invoice_nmbr'];
        if($start_limit>-1){
          $SQL = "SELECT ps.*, cu.customer_name as customer_name, cu.address as address, cu.mobile_no as mobile
             FROM $this->table ps
             INNER JOIN $this->table1 cu
             ON ps.customer_id=cu.id
             WHERE ps.type = 'SL'
             AND ps.invoice_nmbr like '%$search%'
             ORDER BY ps.id ASC limit $start_limit,".PAGE_SIZE;
             $results = $this->db->query($SQL);

       }else{
           $results = $this->db->where(['invoice_nmbr'=>'$search'])->order_by('id', 'ASC')->get($this->table, $select);
          }
            if($results){
                return $results;
            }
            return false;
    }
    else if($data['cuname'] != '' ){
    	$search = $data['cuname'];    	
        if($start_limit>-1){        
         $SQL = "SELECT ps.*, cu.customer_name as customer_name, cu.address as address, cu.mobile_no as mobile
             FROM $this->table ps
             INNER JOIN $this->table1 cu
             ON ps.customer_id=cu.id
             WHERE ps.type = 'SL'
             AND cu.customer_name like '%$search%'
             ORDER BY ps.id ASC limit $start_limit,".PAGE_SIZE;
             $results = $this->db->query($SQL);

       }else{
           $results = $this->db->where(['customer_name'=>'$search'])->order_by('id', 'ASC')->get($this->table1, $select);
          }
            if($results){
                return $results;
            }
            return false;
  }else if($data['phnum'] != '' ){
    	$search = $data['phnum'];
        if($start_limit>-1){
          $SQL = "SELECT ps.*, cu.customer_name as customer_name, cu.address as address, cu.mobile_no as mobile
             FROM $this->table ps
             INNER JOIN $this->table1 cu
             ON ps.customer_id=cu.id
             WHERE ps.type = 'SL'
             AND cu.mobile_no like '%$search%'
             ORDER BY ps.id ASC limit $start_limit,".PAGE_SIZE;
             $results = $this->db->query($SQL);

       }else{
           $results = $this->db->where(['mobile_no'=>'$search'])->order_by('id', 'ASC')->get($this->table1, $select);
          }
            if($results){
                return $results;
            }
            return false;
  }
  } 

	public function getproduct($select = "*"){
		$result = $this->db->order_by('id', 'DESC')->_limit(0, 10)->get($this->table1, $select);
		if($result)
            return $result;
        return false;

	}

	public function sales_delete($id){
	   //$result = $this->db->where(array('id'=>$id))->delete(MEDI_SALES);
		$results = $this->db->where(['id'=>$id])->get(MEDI_SALES);
		$cust_id = $results[0]['customer_id'];
		$result = $this->db->where(array('id'=>$id))->delete(MEDI_SALES);
		$result_d = $this->db->where(array('id'=>$cust_id))->delete(CUSTOMER_INFO);
    	 if($result){
            return $result;
           }
            return false;
	}

}

?>