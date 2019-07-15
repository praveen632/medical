<?php
  include(dirname(dirname(__FILE__)).'/include/includes.php');
  $objTaxlist = new Sales;
  $data['invoice_nmbr'] = $_REQUEST['invoice_nmbr'];
  $data['cuname'] = $_REQUEST['cuname'];
  $data['phnum'] = $_REQUEST['phnum'];
  if($_REQUEST['invoice_nmbr']=="" && $_REQUEST['cuname']=="" && $_REQUEST['phnum']==""){
       $rst = $objTaxlist->getTax(['id']);
       $arr_rst['total_no_records'] = count($rst);
       $rst = $objTaxlist->getTax('*', $_REQUEST['start']);
       $arr_rst['rst'] = $rst;
       echo json_encode($arr_rst);
       
  } 
  else
  {
       $rst = $objTaxlist->getTaxBySearch($data,['id']);
       $arr_rst['total_no_records'] = count($rst);
       $rst = $objTaxlist->getTaxBySearch($data,'*', $_REQUEST['start']);
       $arr_rst['rst'] = $rst;
       echo json_encode($arr_rst);
  }
?>