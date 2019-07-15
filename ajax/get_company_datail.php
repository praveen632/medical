<?php
include(dirname(dirname(__FILE__)).'/include/includes.php');
$invoice = new Invoice;
$result =  $invoice->get_company($_REQUEST['company_id']);	
echo $result = $result[0]['name'];
?>