<?php
  include(dirname(dirname(__FILE__)).'/include/includes.php');
  $perchaisestock = new Perchaisestock;
  if(isset($_REQUEST['txtSearch']) && !empty($_REQUEST['txtSearch'])){
       $rst = $perchaisestock->getProductsBySearch($_REQUEST['txtSearch']);
       echo json_encode($rst);
  } 
  else
  {
       $rst = $perchaisestock->getproduct();
       echo json_encode($rst);
  }
?>