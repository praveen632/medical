<?php
	class Cashinvoice{
	
            public $db ;
            public  function __construct() {
                $this->db = new Mysql();
				$this->table = PRODUCT;
				$this->table1 = COMPANY;
				$this->table2 = PRODUCTTYPE;
				$this->table3 = PRODUCTUNIFORM;
                $this->table5 = MEDI_SALES;
                $this->table6 = CUSTOMER_INFO;
                $this->table7 = CMS_USERS;
                $this->table8 = MEDI_TAX_LIST;
            }

            public function get_tax($id,$select = '*'){
               $results = $this->db->where(['1'=>'1'])->in(['id'=>$id])->get($this->table8, $select);
                if($results)
                    return $results;

                return false;
            }

            public function getuser_detail($select = '*'){
               $results = $this->db->where(['id'=>'1'])->get($this->table7, $select);
                if($results)
                    return $results;

                return false;
            }
            public function getCompanyList($select = ['id','name','description']){
               $results = $this->db->where(['1'=>'1'])->get($this->table1, $select);
                if($results)
                    return $results;

                return false;
            }

            public function getProductType($select = ['id','name','product_uniform']){
               $results = $this->db->where(['1'=>'1'])->get($this->table2, $select);
                if($results)
                    return $results;

                return false;
            }

            public function insert_product_sales($data){
               $results = $this->db->insert($this->table5, $data);
               //$inv = $this->db->insert_id($results);
               //$invdata = "$inv" . 10;
              // $SQL = "UPDATE $this->table5 SET invoice_nmbr = '$invdata' WHERE id = '$inv' ";
              // $this->db->querys($SQL);
                if($results)
                    return $results;
                return false;
            }
            
            public function getProductUniform($select = ['id','name']){
               $results = $this->db->where(['1'=>'1'])->get($this->table3, $select);
                if($results)
                    return $results;

                return false;
            }
			
			public function getProductdetail($id, $select = '*'){
				$results = $this->db->where(['id'=>$id])->get($this->table, $select);
                if($results)
                    return $results;

                return false;
			}

            public function user_info($data)
            {
                $result = $this->db->insert($this->table6, $data);
                $results = $this->db->insert_id($result);
                if($results)
                     return $results;

                 return false;
            }


			
            public function user_cheak($phone)
            {
                $result = $this->db->where(['mobile_no'=>$phone])->get($this->table6);
                //print_r($result);

                //$results = $this->db->insert_id($result);
                if($result)
                     return $result;

                 return false;
            }

             public function get_last_invoice()
            {
                $result = $this->db->where(['type'=>'SL'])->get($this->table5);
                //print_r($result);
                 if($result)
                      return $result;
                  return false;
            }


            public function update_user_info($mob_no, $data){

                $results = $this->db->where(['mobile_no'=>$mob_no])->update($this->table6, $data);
                $result = $this->db->where(['mobile_no'=>$mob_no])->get($this->table6);
                $result = $result[0]['id'];
                if($result)
                    return $result;

                return false;
            }

			public function getStock($pro_id, $select = '*'){

                $results = $this->db->where(['product_id'=>$pro_id],['status'=>'ST'])->get($this->table5, $select);
                if($results)
                    return $results;

                return false;
            }


			public function updateStock($pro_id, $data, $select = '*'){
                $results = $this->db->where(['id'=>$pro_id])->update($this->table5, $data);
                if($results)
                    return $results;

                return false;
            }
            public function updateproduct($pro_id, $data, $select = '*'){
                $results = $this->db->where(['id'=>$pro_id])->update($this->table, $data);
                if($results)
                    return $results;

                return false;
            }


            //for product management................................
            public function getProducts($select = '*'){
                $SQL="SELECT distinct(ps.name), ps.*, pr.batch_no, pr.perchaise_date
                     FROM $this->table5 pr
                     INNER JOIN $this->table ps
                     ON pr.product_id = ps.id
                     WHERE pr.type = 'ST' AND pr.stock_status = '1' AND pr.rest_stock > 0 limit 0, 10";
                //$SQL="SELECT *FROM $this->table2 WHERE created_at between '2017-07-18' AND '2017-07-19'";
                $results = $this->db->query($SQL);
                // $results = $this->db->where(['1'=>'1'])->order_by('id', 'DESC')->_limit(0, 10)->get($this->table, $select);
                if($results)
                     return $results;

                 return false;
            }

             public function getProductById($id, $select = '*'){
                $results = $this->db->where(['id'=>$id])->get($this->table, $select);
                if($results)
                    return $results;

                return false;
            }

            public function getProductsBySearch($search_value, $select = '*'){
                $SQL="SELECT distinct(ps.name), ps.*, pr.batch_no, pr.perchaise_date
                     FROM $this->table5 pr
                     INNER JOIN $this->table ps
                     ON pr.product_id=ps.id
                     WHERE ps.name like '$search_value%' AND pr.type = 'ST' AND stock_status = '1' AND pr.rest_stock > 0 limit 0, 10";
                //$SQL="SELECT *FROM $this->table2 WHERE created_at between '2017-07-18' AND '2017-07-19'";
                $results = $this->db->query($SQL);

                //$results = $this->db->where(['1'=>'1'])->_like(['name'=>$search_value])->order_by('id', 'DESC')->get($this->table, $select);
                //print_r($results);
                if($results)
                    return $results;

                return false;
            }

            public function getCompanyProductsBySearch($search_value, $select = '*'){
                     $SQL = "SELECT distinct(ps.name), ps.*, pr.batch_no, pr.perchaise_date
                     FROM $this->table5 pr
                     INNER JOIN $this->table ps INNER JOIN $this->table1 pc ON pr.product_id = ps.id AND pc.id = ps.company_id                     
                     WHERE pc.name like '$search_value%' AND pr.type = 'ST' AND stock_status = '1' AND pr.rest_stock > 0 limit 0, 10";
               //  $SQL="SELECT distinct(ps.name), ps.*, pr.batch_no
               //       FROM $this->table ps
               //       INNER JOIN $this->table5 pr
               //       ON ps.name like '$search_value%'
               //       WHERE pr.type = 'ST' AND stock_status = '1' AND pr.rest_stock > 0 limit 0, 10";
                     $results = $this->db->query($SQL);
                //$SQL="SELECT *FROM $this->table2 WHERE created_at between '2017-07-18' AND '2017-07-19'";
                //$results = $this->db->query($SQL);
                //$results = $this->db->where(['1'=>'1'])->_like(['name'=>$search_value])->order_by('id', 'DESC')->get($this->table1, ['id','name']);
                //$ids='';
                //print_r($results);
                // if($results){
	               //  foreach ($results as $val) {
	               //  	$ids .= ','.$val['id'];
	               //  }
                // }
                // if($ids != '')
                // 	$ids = substr($ids, 1);
                // $results = $this->db->where(['1'=>'1'])->in(['company_id'=>$ids])->order_by('id', 'DESC')->get($this->table, $select);
                if($results)
                    return $results;

                return false;
            }
     }        
?>