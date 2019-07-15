<?php
include(dirname(dirname(__FILE__)).'/include/includes.php');
$cashinvoice = new Cashinvoice;
$data = $_REQUEST;
$myArray = json_decode($data['product_data'], true);

// if(!isset($myArray['mobile_no']) || !empty($myArray['mobile_no'])) {
// 	echo 'invalid Data';
// 	exit;
// }
$user_info['customer_name'] = $myArray['name'];
$user_info['mobile_no'] = $myArray['mobile_no'];
$user_info['address'] = $myArray['address'];
$user_info['tin_no'] = $myArray['tin_no'];
//print_r($user_info);
$cheak_user = $cashinvoice->user_cheak($myArray['mobile_no']);
if($cheak_user)
{
	$get_result = $cashinvoice->update_user_info($user_info['mobile_no'], $user_info);
}
else
{
	$get_result = $cashinvoice->user_info($user_info);
}
$cheak_user = $cashinvoice->get_last_invoice();
$date_no = count($cheak_user);
$cheak_user = $cheak_user[$date_no-1];
$invoice_no = $cheak_user['id'];
if($invoice_no)
{
	$invoice_no = $invoice_no+1;
}
else{
	$invoice_no = 1;
}
$data1['invoice_nmbr'] = $invoice_no;
//sprintf("%03d",$x);
//echo $x;
$data1['customer_id'] = $get_result;
$data1['date'] = $myArray['cash_invoice_date']." ".$myArray['cash_invoice_time'];
$data1['payment_type'] = $myArray['payment_type'];
$len  = count($myArray['products']);
//print_r($myArray['products']);
$product_id = "";
$product_uniform = "";
$product_quantity = "";
$product_total = "";
$product_batch = "";
for($i=0;$i<$len;$i++)
{
	$data1['product_id'] = $myArray['products'][$i]['id'];
	$data1['uniform_type_id'] = $myArray['products'][$i]['product_uniform'];
	$data1['product_quantity'] = $myArray['products'][$i]['quantity'];
	$data1['total_amount'] = $myArray['products'][$i]['total'];
	$data1['batch_no'] = $myArray['products'][$i]['product_batch'];
	$data1['gross_total'] = $myArray['products'][$i]['gross_total'];
	$tax = $cashinvoice->get_tax($myArray['products'][$i]['tax_id']);
	$tax_val_in = 0;
	foreach ($tax as $tax_val) {
		$tax_val_in += $tax_val['tax_rate'];
	}
	//echo $tax_val_in;
	$data1['tax'] = $tax_val_in;
	$data1['type'] = 'SL';
	$data1['discount'] = $myArray['products'][$i]['discount'];
	$result = $cashinvoice->insert_product_sales($data1);
}
?>