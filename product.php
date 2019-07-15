<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');
include(DIR_COMMON_PATH.'nav.php');
$user = new Product();
$result = $user->getProduct();
//print_r($result);die;
include(DIR_TEMPLATE_PATH.'product.php');
include(DIR_COMMON_PATH.'footer.php');
?>