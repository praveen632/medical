<?php
	include(dirname(dirname(__FILE__)).'/include/includes.php');
  	$cashinvoice = new Cashinvoice;
  	$tax = $cashinvoice->get_tax($_REQUEST['tax_id']);
  	echo json_encode($tax);
?>