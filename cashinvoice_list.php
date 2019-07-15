<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');


$productname = new Sales();
$results = $productname->getproduct();

include(DIR_COMMON_PATH.'nav.php');
include(DIR_TEMPLATE_PATH.'cashinvoice_list.php');
include(DIR_COMMON_PATH.'footer.php');
?>