<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');
include(DIR_COMMON_PATH.'nav.php');
$user = new Product_type();
$result = $user->getuniform();
// if($result){
//     	echo $datas = json_encode($result);
//     }else{
//     	echo $datas = '0';
//     }
include(DIR_TEMPLATE_PATH.'producttype_add.php');
include(DIR_COMMON_PATH.'footer.php');
?>