<?php 

class Perchaisestock{

	public $db;
	private $table;

	public function __construct(){
		$this->db = new Mysql();
		$this->table = MEDI_SALES;
		$this->table1 = PRODUCTTYPE;
		$this->table2 = PRODUCT;
    $this->table3 = CUSTOMER_INFO;
	}

	public function get($select = "*"){
		$result = $this->db->get($this->table, $select);
		if($result)
            return $result;
        return false;

	}

	public function save($data, $select = "*"){    
    $rest_stock = $data['rest_stock'];
    $id = $data['product_id'];
    $quantity = $this->db->where(['id'=>$id])->get($this->table2, $select);   
    $stock_q = $quantity[0]['quantity_in_stock'];
    $total_uq = $stock_q + $rest_stock;
    $SQL = "UPDATE $this->table2 SET quantity_in_stock = '$total_uq' WHERE id = '$id' ";
    $this->db->querys($SQL);
		$result = $this->db->insert($this->table, $data);
		return $result;
	}

  public function save_customer($data_info, $select = "*"){
        // $cu_inf['customer_name'] = $data_info['name'];
        // $cu_inf['mobile_no'] = $data_info['mobile'];
        // $cu_inf['address'] = $data_info['address'];
        $result_id = $this->db->insert($this->table3, $data_info);    
        $results = $this->db->insert_id($result_id);
        return $results;
  }

	public function getProductsBySearch($search_value, $select = '*'){
		$results = $this->db->where(['1'=>'1'])->_like(['name'=>$search_value])->order_by('id', 'DESC')->get($this->table2, $select);
                if($results)
                    return $results;

                return false;
	}

	public function getproduct($select = '*'){
		$results = $this->db->where(['1'=>'1'])->order_by('id', 'DESC')->_limit(0, 10)->get($this->table2, $select);
                if($results)
                    return $results;
                return false;
	}


	public function edit($id, $select = "*"){
     $SQL = "SELECT ps.*, pr.customer_name as customer_name, pr.mobile_no as mobile_no, pr.address as address
              FROM $this->table ps
              INNER JOIN $this->table3 pr
              ON ps.customer_id = pr.id
              WHERE ps.id = '$id'";
              $results = $this->db->query($SQL);


		//$results = $this->db->where(['id'=>$id])->get($this->table, $select);
		if($results){
			return $results;
		}
		return false;
	}

	public function update($id, $data){
		$results = $this->db->where(['id'=>$id])->update($this->table, $data);
      $result = $this->db->where(['id'=>$id])->get(MEDI_SALES);
    $id = $result[0]['customer_id'];
		if($id){
			return $id;
		}
		return false;
	}


  public function update_customer($data_info, $ids){
    $results = $this->db->where(['id'=>$ids])->update($this->table3, $data_info);
      if($results){
        return $results;
      }
      return false;
  }

	public function delete($id){
		$results = $this->db->where(['id'=>$id])->delete($this->table);
		if($results){
			return $results;
		}
		return false;
	}

	public function getproductname($select = "*"){
	   $results = $this->db->where(['1'=>'1'])->order_by('id', 'DESC')->_limit(0, 10)->get($this->table2, $select);
		if($results){
			return $results;
		}
		return false;
	}

  public function getproduc_detail($id, $select = "*"){
     $results = $this->db->where(['id'=>$id])->get($this->table2, $select);
    if($results){
      return $results;
    }
    return false;
  }
	
	 public function getTax($select = '*', $start_limit=-1){
       if($start_limit>-1){
           $SQL = "SELECT ps.*, pr.name as product, cui.customer_name as name
             FROM $this->table ps
             INNER JOIN $this->table2 pr          
             ON ps.product_id=pr.id
             INNER JOIN $this->table3 cui
             ON ps.customer_id=cui.id
             WHERE ps.type = 'ST'
             ORDER BY ps.id DESC limit $start_limit,".PAGE_SIZE;
             $results = $this->db->query($SQL);

       }else{
           $results = $this->db->where(['type'=>'ST'])->order_by('id', 'DESC')->get($this->table, $select);
          }
            if($results){
                return $results;
            }
            return false;
    }

    public function getTaxBySearch($data, $select = '*',$start_limit=-1){       
         if($data['bill'] != '' ){
            $search = $data['bill'];
            if($start_limit>-1){
            $SQL = "SELECT ps.*, pr.name as product, cui.customer_name as name
             FROM $this->table ps
             INNER JOIN $this->table2 pr
             ON ps.product_id=pr.id
             INNER JOIN $this->table3 cui
             ON ps.customer_id=cui.id
             AND ps.invoice_nmbr like '%$search%'
             WHERE ps.type = 'ST'
             ORDER BY ps.id DESC limit $start_limit,".PAGE_SIZE;
             $results = $this->db->query($SQL);

             }else{
                 $results = $this->db->where(['1'=>'1'])->_like(['invoice_nmbr'=>$search])->order_by('id', 'DESC')->get($this->table, $select);
             }
            if($results){
                return $results;
            }
            return false;
       }
       else if($data['vname'] != ''){
         $search = $data['vname'];
            if($start_limit>-1){
           $SQL = "SELECT ps.*, pr.name as product, cui.customer_name as name
             FROM $this->table ps
             INNER JOIN $this->table2 pr
             ON ps.product_id=pr.id
             INNER JOIN $this->table3 cui
             ON ps.customer_id=cui.id
             AND cui.customer_name like '%$search%'
             ORDER BY ps.id DESC limit $start_limit,".PAGE_SIZE;
             $results = $this->db->query($SQL);

       }else{
           $results = $this->db->where(['1'=>'1'])->_like(['customer_name'=>$search])->order_by('id', 'DESC')->get($this->table3, $select);
          }
            if($results){
                return $results;
            }
            return false;
       }
       else if($data['pname'] != ''){
            $search = $data['pname'];
            if($start_limit>-1){
            $SQL = "SELECT ps.*, pr.name as product, cui.customer_name as name
             FROM $this->table ps
             INNER JOIN $this->table2 pr
             ON ps.product_id=pr.id
             INNER JOIN $this->table3 cui
             ON ps.customer_id=cui.id
             AND pr.name like '%$search%'
             ORDER BY ps.id DESC limit $start_limit,".PAGE_SIZE;
             $results = $this->db->query($SQL);

       }else{
           $results = $this->db->where(['1'=>'1'])->_like(['name'=>$search])->order_by('id', 'DESC')->get($this->table2, $select);
          }
            if($results){
                return $results;
            }
            return false;
       }
       else if($data['bname'] != ''){
         $search = $data['bname'];
            if($start_limit>-1){
            $SQL = "SELECT ps.*, pr.name as product, cui.customer_name as name
             FROM $this->table ps
             INNER JOIN $this->table2 pr
             ON ps.product_id=pr.id
             INNER JOIN $this->table3 cui
             ON ps.customer_id=cui.id
             AND ps.batch_no like '%$search%'
             ORDER BY ps.id DESC limit $start_limit,".PAGE_SIZE;
             $results = $this->db->query($SQL);

       }else{
           $results = $this->db->where(['1'=>'1'])->_like(['batch_no'=>$search])->order_by('id', 'DESC')->get($this->table, $select);
          }
            if($results){
                return $results;
            }
            return false;
       }
          
    }
}

?>