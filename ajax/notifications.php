<?php
include(dirname(dirname(__FILE__)).'/include/includes.php');
  $objTaxlist = new Expired_Medicine;
  $arr_rst = $objTaxlist->getNotifications();
   if($arr_rst=='')
  {
  	$arr_rst['total_no_records'] = 0;
  }
  else
  {
  	$arr_rst['total_no_records'] = count($arr_rst);
  }
  //print_r($arr_rst);
  echo json_encode($arr_rst);
?>