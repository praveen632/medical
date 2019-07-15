<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');
include(DIR_COMMON_PATH.'nav.php');
$user = new Product();
// $result = $user->getdata();
include(DIR_TEMPLATE_PATH.'product_add.php');
include(DIR_COMMON_PATH.'footer.php');
?>