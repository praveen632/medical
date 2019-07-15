<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');
include(DIR_COMMON_PATH.'nav.php');


$taxlist = new Taxlist();
$id = $_GET['id'];

$results = $taxlist->getedit($id);

include(DIR_TEMPLATE_PATH.'tax_list_edit.php');
include(DIR_COMMON_PATH.'footer.php');
?>