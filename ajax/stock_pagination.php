<?php
  include(dirname(dirname(__FILE__)).'/include/includes.php');
  $objTaxlist = new Perchaisestock;
 $data['bill'] = $_REQUEST['bill'];
 $data['vname'] = $_REQUEST['vname'];
 $data['pname'] = $_REQUEST['pname'];
 $data['bname'] = $_REQUEST['bname'];
 
    if($_REQUEST['bill']=="" && $_REQUEST['vname']=="" && $_REQUEST['pname']=="" && $_REQUEST['bname']==""){
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