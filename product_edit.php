<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');
include(DIR_COMMON_PATH.'nav.php');
$user = new Product();
$id = $_GET['id'];
$result = $user->getedit($id);

include(DIR_TEMPLATE_PATH.'product_edit.php');
include(DIR_COMMON_PATH.'footer.php');
?>