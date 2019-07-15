<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');
include(DIR_COMMON_PATH.'nav.php');
$cash= new Cashinvoice();
$get_user_detail = $cash->getuser_detail();
//print_r($get_user_detail);
include(DIR_TEMPLATE_PATH.'cashinvoice_bill.php');
include(DIR_COMMON_PATH.'footer.php');
?>