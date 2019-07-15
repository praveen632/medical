<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');
include(DIR_COMMON_PATH.'nav.php');


$stock = new Perchaisestock();
$id = $_GET['id'];
$results = $stock->edit($id);

include(DIR_TEMPLATE_PATH.'perchaise_stock_edit.php');
include(DIR_COMMON_PATH.'footer.php');
?>