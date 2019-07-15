<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');
include(DIR_COMMON_PATH.'nav.php');
$user = new Sales_report();
$id = $_GET['id'];
$result = $user->getproduct_list($id);

include(DIR_TEMPLATE_PATH.'sales_product_list.php');
include(DIR_COMMON_PATH.'footer.php');
?>