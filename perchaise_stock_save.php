<?php
include('include/includes.php');
$stock = new Perchaisestock();
$data = array();
$data['invoice_nmbr'] = $_REQUEST['bill_number'];
$data_info['customer_name'] = $_REQUEST['name'];
$data_info['mobile_no'] = $_REQUEST['mobile'];
$data_info['address'] = $_REQUEST['address'];
$data['uniform_type_id'] = $_REQUEST['product_uniform'];
$data['date'] = $_REQUEST['current_date'];
$request = $stock->save_customer($data_info);
$data['customer_id'] = $request;
foreach ($_REQUEST['cost_price'] as $k=>$cost_price) {
	$data['type'] = 'ST';
	$data['cost_price'] = $cost_price;
	$data['mrp'] = $_REQUEST['mrp'][$k];
	$data['product_id'] = $_REQUEST['product_id'][$k];
	$data['product_quantity'] = $_REQUEST['quantity_uniform'][$k];
	$data['rest_stock'] = $_REQUEST['quantity_uniform'][$k];
	$data['batch_no'] = $_REQUEST['batch_nmbr'][$k];
	$data['perchaise_date'] = $_REQUEST['perchaise_date'][$k];
	$data['expire_date'] = $_REQUEST['expire_date'][$k];
	$data['payment_type'] = "Cash";
	$data['total_amount'] = $cost_price*$_REQUEST['quantity_uniform'][$k];
	$data['discount'] = 0;
	$data['tax'] = 0;
	$data['gross_total'] = 0;
	
	$request = $stock->save($data);
	unset($data['cost_price']);
	unset($data['mrp']);
	unset($data['product']);
	unset($data['quantity_uniform']);
	unset($data['rest_stock']);
	unset($data['batch_nmbr']);
	unset($data['perchaise_date']);
	unset($data['expire_date']);
	unset($data['payment_type']);
	unset($data['total_amount']);
	unset($data['discount']);
	unset($data['tax']);
	unset($data['gross_total']);

}
if($request){
	echo '1';
}else{
	echo '0';
}
?>