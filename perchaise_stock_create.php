<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');

$stock = new Perchaisestock();

include(DIR_COMMON_PATH.'nav.php');
include(DIR_TEMPLATE_PATH.'perchaise_stock_create.php');
include(DIR_COMMON_PATH.'footer.php');


?>