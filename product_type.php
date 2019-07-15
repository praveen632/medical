<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');
include(DIR_COMMON_PATH.'nav.php');
$user = new Product_type();
$result = $user->getProduct();

include(DIR_TEMPLATE_PATH.'product_type.php');
include(DIR_COMMON_PATH.'footer.php');
?>