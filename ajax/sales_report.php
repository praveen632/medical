<?php
  include(dirname(dirname(__FILE__)).'/include/includes.php');
  $objTaxlist = new Sales_report;
  // $data['product_name'] = $_REQUEST['product_name'];
  $data['ptype'] = $_REQUEST['ptype'];
  $data['inum'] = $_REQUEST['inum'];
  $data['from_date'] = $_REQUEST['from_date'];
  $data['to_date'] = $_REQUEST['to_date'];

    if($_REQUEST['ptype']=="" && $_REQUEST['inum']=="" && $_REQUEST['from_date']=="" && $_REQUEST['to_date'] == ""){
       
       $rst = $objTaxlist->getTax(['id']);
       $arr_rst['total_no_records'] = count($rst);
       $rst = $objTaxlist->getTax('*', $_REQUEST['start']);
       $arr_rst['rst'] = $rst;
       echo json_encode($arr_rst);

    }
    else
    {
       $rst = $objTaxlist->getTaxBySearch($data, ['id']);
       if(!$rst)
       {
           $arr_rst = array('error'=>1); 
       }
        else
       {
           $arr_rst['total_no_records'] = count($rst);
           $rst = $objTaxlist->getTaxBySearch($data,'*', $_REQUEST['start']);
           if(!$rst)
           {
                $arr_rst = array('error'=>1); 
           }
           else
           {
                $arr_rst['rst'] = $rst;
           }           
       }
      echo json_encode($arr_rst);
  } 

?>