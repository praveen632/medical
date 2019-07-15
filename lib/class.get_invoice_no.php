<?php 
class Invoice{

	public $db;
	private $table;

	   public function __construct(){
        		$this->db = new Mysql();
        		$this->table = MEDI_SALES;
            $this->table1 = COMPANY;
    	}
      public function get_invoice($select = '*')
      {
            $get_all = $this->db->get($this->table, $select);
            foreach($get_all as $get_de)
            {
            	$invoice_final = $get_de;
            }
            if($get_all)
            {
             return $invoice_final['invoice_nmbr'];
            
            }
            else
             	return false;
      }
      public function get_company($id, $select = '*')
      {
        $result = $get_all = $this->db->where(['id'=>$id])->get($this->table1, $select);
        //print_r($result);
        if($result)
          return $result;
        else
        return false;
      }
}
?>