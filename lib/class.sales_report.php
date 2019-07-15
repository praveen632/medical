<?php 

class Sales_report{

	public $db;
	private $table;

	public function __construct(){
		$this->db = new Mysql();
		$this->table = MEDI_SALES;
    $this->table2 = PRODUCT;
    $this->table3 = PRODUCTUNIFORM;	
    $this->table4 = CUSTOMER_INFO;
    $this->table5 = PRODUCTTYPE;	
	}

  public function getTax($select = '*', $start_limit = -1)
  {
          if($start_limit>-1){
                $results = $this->db->order_by('id', 'DESC')->_limit($start_limit, PAGE_SIZE)->get($this->table, $select);
                $data_uni = '';
                $data_coust = '';
                $data_pro = '';
                  foreach($results as $res)
                  {
                    $data_pro .= $res['product_id'].",";
                    $data_coust .= $res['customer_id'].",";
                    $data_uni .= $res['uniform_type_id'].",";
                  }
                    $data_uni = rtrim($data_uni,',');
                    $data_coust = rtrim($data_coust,',');
                    $data_pro = rtrim($data_pro,',');

                    
                // for medicin name
                    $SQL = "SELECT name, id, product_id  FROM ".$this->table2." WHERE id IN (".$data_pro.")";
                    $resultss = $this->db->query($SQL);
                    $no_uniform_name='';
                          foreach($resultss as $res_no)
                          {
                            $no_uniform_name .= $res_no['product_id'].",";
                          }
                          $no_uniform_name = rtrim($no_uniform_name,',');
                          $array_pro = array();
                                foreach($resultss as $pro)
                                {
                                  $array_pro[$pro['id']]=$pro['name'];
                                }
                                  foreach ($results as $k=>$in_data) {
                                    
                                      $uniformname='';
                                      foreach (explode(',', $in_data['product_id']) as $val) {
                                          $uniformname .= (isset($array_pro[$val]) ? $array_pro[$val] : '').', ';
                                      }
                                      //print_r($uniformname);
                                      $results[$k]['product_uniform'] = trim(substr(trim($uniformname), 0, -1));
                                      $uniformname = '';
                                 }
               
                // uniform type
                $SQL_uni = "SELECT name, id  FROM ".$this->table3." WHERE id IN (".$data_uni.")";
                $results_uni = $this->db->query($SQL_uni); 
                $array_uni = array();
                foreach($results_uni as  $res_uni)
                {
                   $array_uni[$res_uni['id']]=$res_uni['name'];
                }

                foreach ($results as $k=>$in_data) { 
                      // print_r($in_data['unifo rm_type_id']) ;      
                    $uniformnamew='';
                    foreach (explode(',', $in_data['uniform_type_id']) as $val) {
                        $uniformnamew .= (isset($array_uni[$val]) ? $array_uni[$val] : '').', ';
                    }
                    $results[$k]['uniform_name'] = trim(substr(trim($uniformnamew), 0, -1));
                    $uniformnamew = '';
                }

                //product type

                $SQL_uni_type = "SELECT name, id  FROM ".$this->table5." type WHERE id IN (".$no_uniform_name.")";
                $results_uni_type = $this->db->query($SQL_uni_type); 
                $array_uni_type = array();
                foreach($results_uni_type as  $res_uni_type)
                {
                   $array_uni_type[$res_uni_type['id']]=$res_uni_type['name'];
                } 
                foreach ($results as $k=>$in_data) {
                    $results[$k]['uniform_type'] = (isset($array_uni_type[$in_data['customer_id']]) ? $array_uni_type[$in_data['customer_id']] : '');   
                } 
           

                 //for coustomer information
                $SQL_coust = "SELECT customer_name, mobile_no, tin_no, id  FROM ".$this->table4." WHERE id IN (".$data_coust.")";
                $results_coust = $this->db->query($SQL_coust);
                $array_coust = array();
                $res_coust = array();
                foreach($results_coust as  $res_coust)
                {
                   $array_coust[$res_coust['id']]=$res_coust;
                }
                //print_r($array_coust);
                foreach ($results as $k=>$in_data) {
                    $results[$k]['customer_details'] = (isset($array_coust[$in_data['customer_id']]) ? $array_coust[$in_data['customer_id']] : '');   
                }
              }
                else{
                  $results = $this->db->order_by('id', 'ASC')->get($this->table, $select);
                } 
              
                if($results){
                    return $results;
                }
                return false;
  }


  public function getTaxBySearch($data, $select = '*',$start_limit=-1){
    if($data['ptype'] != ''){
      $search = $data['ptype'];
       if($start_limit>-1){
                $results = $this->db->where(['1'=>'1'])->_like(['payment_type'=>$search])->order_by('id', 'ASC')->get($this->table, $select);
                $data_uni = '';
                $data_coust = '';
                $data_pro = '';
                  foreach($results as $res)
                  {
                    $data_pro .= $res['product_id'].",";
                    $data_coust .= $res['customer_id'].",";
                    $data_uni .= $res['uniform_type_id'].",";
                  }
                    $data_uni = rtrim($data_uni,',');
                    $data_coust = rtrim($data_coust,',');
                    $data_pro = rtrim($data_pro,',');
              
                    
                // for medicin name
                 $SQL = "SELECT name, id, product_id  FROM ".$this->table2." WHERE id IN (".$data_pro.") ";
                    $resultss = $this->db->query($SQL);
                    $no_uniform_name='';
                          foreach($resultss as $res_no)
                          {
                            $no_uniform_name .= $res_no['product_id'].",";
                          }
                          $no_uniform_name = rtrim($no_uniform_name,',');
                          $array_pro = array();
                                foreach($resultss as $pro)
                                {
                                  $array_pro[$pro['id']]=$pro['name'];
                                }
                                  foreach ($results as $k=>$in_data) {
                                    
                                      $uniformname='';
                                      foreach (explode(',', $in_data['product_id']) as $val) {
                                          $uniformname .= (isset($array_pro[$val]) ? $array_pro[$val] : '').', ';
                                      }
                                      //print_r($uniformname);
                                      $results[$k]['product_uniform'] = trim(substr(trim($uniformname), 0, -1));
                                      $uniformname = '';
                                 }
               
                // uniform type
                $SQL_uni = "SELECT name, id  FROM ".$this->table3." WHERE id IN (".$data_uni.")";
                $results_uni = $this->db->query($SQL_uni); 
                $array_uni = array();
                foreach($results_uni as  $res_uni)
                {
                   $array_uni[$res_uni['id']]=$res_uni['name'];
                }

                foreach ($results as $k=>$in_data) { 
                      // print_r($in_data['unifo rm_type_id']) ;      
                    $uniformnamew='';
                    foreach (explode(',', $in_data['uniform_type_id']) as $val) {
                        $uniformnamew .= (isset($array_uni[$val]) ? $array_uni[$val] : '').', ';
                    }
                    $results[$k]['uniform_name'] = trim(substr(trim($uniformnamew), 0, -1));
                    $uniformnamew = '';
                }

                //product type

                $SQL_uni_type = "SELECT name, id  FROM ".$this->table5." type WHERE id IN (".$no_uniform_name.")";
                $results_uni_type = $this->db->query($SQL_uni_type); 
                $array_uni_type = array();
                foreach($results_uni_type as  $res_uni_type)
                {
                   $array_uni_type[$res_uni_type['id']]=$res_uni_type['name'];
                } 
                foreach ($results as $k=>$in_data) {
                    $results[$k]['uniform_type'] = (isset($array_uni_type[$in_data['customer_id']]) ? $array_uni_type[$in_data['customer_id']] : '');   
                } 
           

                 //for coustomer information
                $SQL_coust = "SELECT customer_name, mobile_no, tin_no, id  FROM ".$this->table4." WHERE id IN (".$data_coust.")";
                $results_coust = $this->db->query($SQL_coust);
                $array_coust = array();
                $res_coust = array();
                foreach($results_coust as  $res_coust)
                {
                   $array_coust[$res_coust['id']]=$res_coust;
                }
                //print_r($array_coust);
                foreach ($results as $k=>$in_data) {
                    $results[$k]['customer_details'] = (isset($array_coust[$in_data['customer_id']]) ? $array_coust[$in_data['customer_id']] : '');   
                }
              }
                else{
                  $results = $this->db->where(['1'=>'1'])->_like(['payment_type'=>$search])->order_by('id', 'ASC')->get($this->table, $select);
              
                } 
              
                if($results){
                    return $results;
                }
                return false;
    }else if($data['inum'] != ''){
    $search = $data['inum'];
       if($start_limit>-1){
                $results = $this->db->where(['1'=>'1'])->_like(['invoice_nmbr'=>$search])->order_by('id', 'ASC')->get($this->table, $select);
                $data_uni = '';
                $data_coust = '';
                $data_pro = '';
                  foreach($results as $res)
                  {
                    $data_pro .= $res['product_id'].",";
                    $data_coust .= $res['customer_id'].",";
                    $data_uni .= $res['uniform_type_id'].",";
                  }
                    $data_uni = rtrim($data_uni,',');
                    $data_coust = rtrim($data_coust,',');
                    $data_pro = rtrim($data_pro,',');

                    
                // for medicin name
                 $SQL = "SELECT name, id, product_id  FROM ".$this->table2." WHERE id IN (".$data_pro.") ";
                    $resultss = $this->db->query($SQL);
                    $no_uniform_name='';
                          foreach($resultss as $res_no)
                          {
                            $no_uniform_name .= $res_no['product_id'].",";
                          }
                          $no_uniform_name = rtrim($no_uniform_name,',');
                          $array_pro = array();
                                foreach($resultss as $pro)
                                {
                                  $array_pro[$pro['id']]=$pro['name'];
                                }
                                  foreach ($results as $k=>$in_data) {
                                    
                                      $uniformname='';
                                      foreach (explode(',', $in_data['product_id']) as $val) {
                                          $uniformname .= (isset($array_pro[$val]) ? $array_pro[$val] : '').', ';
                                      }
                                      //print_r($uniformname);
                                      $results[$k]['product_uniform'] = trim(substr(trim($uniformname), 0, -1));
                                      $uniformname = '';
                                 }
               
                // uniform type
                $SQL_uni = "SELECT name, id  FROM ".$this->table3." WHERE id IN (".$data_uni.")";
                $results_uni = $this->db->query($SQL_uni); 
                $array_uni = array();
                foreach($results_uni as  $res_uni)
                {
                   $array_uni[$res_uni['id']]=$res_uni['name'];
                }

                foreach ($results as $k=>$in_data) { 
                      // print_r($in_data['unifo rm_type_id']) ;      
                    $uniformnamew='';
                    foreach (explode(',', $in_data['uniform_type_id']) as $val) {
                        $uniformnamew .= (isset($array_uni[$val]) ? $array_uni[$val] : '').', ';
                    }
                    $results[$k]['uniform_name'] = trim(substr(trim($uniformnamew), 0, -1));
                    $uniformnamew = '';
                }

                //product type

                $SQL_uni_type = "SELECT name, id  FROM ".$this->table5." type WHERE id IN (".$no_uniform_name.")";
                $results_uni_type = $this->db->query($SQL_uni_type); 
                $array_uni_type = array();
                foreach($results_uni_type as  $res_uni_type)
                {
                   $array_uni_type[$res_uni_type['id']]=$res_uni_type['name'];
                } 
                foreach ($results as $k=>$in_data) {
                    $results[$k]['uniform_type'] = (isset($array_uni_type[$in_data['customer_id']]) ? $array_uni_type[$in_data['customer_id']] : '');   
                } 
           

                 //for coustomer information
                $SQL_coust = "SELECT customer_name, mobile_no, tin_no, id  FROM ".$this->table4." WHERE id IN (".$data_coust.")";
                $results_coust = $this->db->query($SQL_coust);
                $array_coust = array();
                $res_coust = array();
                foreach($results_coust as  $res_coust)
                {
                   $array_coust[$res_coust['id']]=$res_coust;
                }
                //print_r($array_coust);
                foreach ($results as $k=>$in_data) {
                    $results[$k]['customer_details'] = (isset($array_coust[$in_data['customer_id']]) ? $array_coust[$in_data['customer_id']] : '');   
                }
              }
                else{
                  $results = $this->db->where(['1'=>'1'])->_like(['invoice_nmbr'=>$search])->order_by('id', 'ASC')->get($this->table, $select);
                } 
              
                if($results){
                    return $results;
                }
                return false;
    }else if($data['from_date'] != '' && $data['to_date'] != ''){
      $search_f = $data['from_date'];
      $search_t = $data['to_date'];
       if($start_limit>-1){
                //$results = $this->db->where(['1'=>'1'])->_like(['invoice_nmbr'=>$search])->order_by('id', 'ASC')->get($this->table, $select);
              $SQL="SELECT * FROM $this->table WHERE date between '$search_f' AND '$search_t'";
                $results = $this->db->query($SQL);
                if($results)
                {
                $data_uni = '';
                $data_coust = '';
                $data_pro = '';
                  foreach($results as $res)
                  {
                    $data_pro .= $res['product_id'].",";
                    $data_coust .= $res['customer_id'].",";
                    $data_uni .= $res['uniform_type_id'].",";
                  }
                    $data_uni = rtrim($data_uni,',');
                    $data_coust = rtrim($data_coust,',');
                    $data_pro = rtrim($data_pro,',');

                    
                // for medicin name
                 $SQL = "SELECT name, id, product_id  FROM ".$this->table2." WHERE id IN (".$data_pro.") ";
                    $resultss = $this->db->query($SQL);
                    $no_uniform_name='';
                          foreach($resultss as $res_no)
                          {
                            $no_uniform_name .= $res_no['product_id'].",";
                          }
                          $no_uniform_name = rtrim($no_uniform_name,',');
                          $array_pro = array();
                                foreach($resultss as $pro)
                                {
                                  $array_pro[$pro['id']]=$pro['name'];
                                }
                                  foreach ($results as $k=>$in_data) {
                                    
                                      $uniformname='';
                                      foreach (explode(',', $in_data['product_id']) as $val) {
                                          $uniformname .= (isset($array_pro[$val]) ? $array_pro[$val] : '').', ';
                                      }
                                      //print_r($uniformname);
                                      $results[$k]['product_uniform'] = trim(substr(trim($uniformname), 0, -1));
                                      $uniformname = '';
                                 }
               
                // uniform type
                $SQL_uni = "SELECT name, id  FROM ".$this->table3." WHERE id IN (".$data_uni.")";
                $results_uni = $this->db->query($SQL_uni); 
                $array_uni = array();
                foreach($results_uni as  $res_uni)
                {
                   $array_uni[$res_uni['id']]=$res_uni['name'];
                }

                foreach ($results as $k=>$in_data) { 
                      // print_r($in_data['unifo rm_type_id']) ;      
                    $uniformnamew='';
                    foreach (explode(',', $in_data['uniform_type_id']) as $val) {
                        $uniformnamew .= (isset($array_uni[$val]) ? $array_uni[$val] : '').', ';
                    }
                    $results[$k]['uniform_name'] = trim(substr(trim($uniformnamew), 0, -1));
                    $uniformnamew = '';
                }

                //product type

                $SQL_uni_type = "SELECT name, id  FROM ".$this->table5." type WHERE id IN (".$no_uniform_name.")";
                $results_uni_type = $this->db->query($SQL_uni_type); 
                $array_uni_type = array();
                foreach($results_uni_type as  $res_uni_type)
                {
                   $array_uni_type[$res_uni_type['id']]=$res_uni_type['name'];
                } 
                foreach ($results as $k=>$in_data) {
                    $results[$k]['uniform_type'] = (isset($array_uni_type[$in_data['customer_id']]) ? $array_uni_type[$in_data['customer_id']] : '');   
                } 
           

                 //for coustomer information
                $SQL_coust = "SELECT customer_name, mobile_no, tin_no, id  FROM ".$this->table4." WHERE id IN (".$data_coust.")";
                $results_coust = $this->db->query($SQL_coust);
                $array_coust = array();
                $res_coust = array();
                foreach($results_coust as  $res_coust)
                {
                   $array_coust[$res_coust['id']]=$res_coust;
                }
                //print_r($array_coust);
                foreach ($results as $k=>$in_data) {
                    $results[$k]['customer_details'] = (isset($array_coust[$in_data['customer_id']]) ? $array_coust[$in_data['customer_id']] : '');   
                }
                }
                else
                {
                   return false;
                }
              }
                else{
                  $results = $this->db->order_by('id', 'ASC')->get($this->table, $select);
                } 
              
                if($results){
                    return $results;
                }
                return false;
    }

  }
}
?>