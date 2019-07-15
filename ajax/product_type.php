<?php
  include(dirname(dirname(__FILE__)).'/include/includes.php');
  $objTaxlist = new Product_type;
  if(!empty($_REQUEST['search'])){
       $rst = $objTaxlist->getTaxBySearch($_REQUEST['search'],['id']);
       if($rst=='')
       {
          $arr_rst['error'] = 1;
       }
       else
       {
       $arr_rst['total_no_records'] = count($rst);
       $rst = $objTaxlist->getTaxBySearch($_REQUEST['search'],'*', $_REQUEST['start']);
       $arr_rst['rst'] = $rst;
       }
       echo json_encode($arr_rst);
  } 
  else
  {
       $rst = $objTaxlist->getTax(['id']);
       $arr_rst['total_no_records'] = count($rst);
       $rst = $objTaxlist->getTax('*', $_REQUEST['start']);
       $arr_rst['rst'] = $rst;
       echo json_encode($arr_rst);
  }
?>