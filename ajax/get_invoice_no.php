<?php
include(dirname(dirname(__FILE__)).'/include/includes.php');
$invoice = new Invoice;
$result =  $invoice->get_invoice();
echo $result;
//print_r($result[$no[]]);
?>