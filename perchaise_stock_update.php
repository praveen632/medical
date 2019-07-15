<?php
include('include/includes.php');

$stock = new Perchaisestock();

$id=$_POST['id'];
$data['invoice_nmbr'] = $_POST['bill_number'];
$data['product_id'] = $_POST['product_id'];
$data['cost_price'] = $_POST['cost_price'];
$data['mrp'] = $_POST['mrp'];
$data['product_quantity'] = $_POST['quantity_uniform'];
$data['batch_no'] = $_POST['batch_nmbr'];
$data['perchaise_date'] = $_POST['perchaise_date'];
$data['expire_date'] = $_POST['expire_date'];

$results = $stock->update($id, $data);
$ids = $results;

$data_info['customer_name'] = $_POST['name'];
$data_info['mobile_no'] = $_POST['mobile'];
$data_info['address'] = $_POST['address'];
$request = $stock->update_customer($data_info, $ids);

if ($results) {
		   	echo '1';
		     	//$data = 'yes';	                        
		    } else {
		    	echo '0';
		    	//$data = 'no';	      
		    }


?>