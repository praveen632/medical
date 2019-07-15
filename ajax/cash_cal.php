<?php 
include(dirname(dirname(__FILE__)).'/include/includes.php');
$cashinvoice = new Cashinvoice;
$product_detail = $cashinvoice->getProductdetail($_REQUEST['product_id']);
$product_stock  = $cashinvoice->getStock($_REQUEST['product_id']);
//print_r($product_detail);
$pro_req_uni = $_REQUEST['product_uniform'];
$produc_uni = $product_detail[0]['product_uniform'];
$qty = $_REQUEST['quantity'];
$pro_id = $_REQUEST['product_id'];
$data = "";
$batch_no= "";
foreach($product_stock as $product)
{
	$total_rest_stock = $product['rest_stock'];
	$id = $product['id'];
	if(($product['rest_stock']!= 0))
		{
			if($produc_uni==$pro_req_uni)
			{
			 	if($total_rest_stock<$qty){	
			 		$total_stock = $product_detail[0]['quantity_in_stock'] - $total_rest_stock ;
			 		$data1['quantity_in_stock'] = $total_stock;
			 		$user_data = $cashinvoice->updateproduct($pro_id, $data1);
					$qty = $qty - $total_rest_stock;
					$data['rest_stock'] = 0;
					$user_data = $cashinvoice->updateStock($id, $data);
					$batch_no = $product['batch_no']; 
				}
				else if($total_rest_stock==$qty){
					$total_stock = $product_detail[0]['quantity_in_stock'] - $qty ;
			 		$data1['quantity_in_stock'] = $total_stock;
			 		$user_data = $cashinvoice->updateproduct($pro_id, $data1);
					$qty = $qty - $total_rest_stock;
					$data['rest_stock'] = 0;
					$user_data = $cashinvoice->updateStock($id, $data);
					if($batch_no=="")
						$batch_no = $product['batch_no'];
					else
						$batch_no = ",".$product['batch_no'];
					break;
				}	
				else
				{
					$total_stock = $product_detail[0]['quantity_in_stock'] - $qty ;
			 		$data1['quantity_in_stock'] = $total_stock;
			 		$user_data = $cashinvoice->updateproduct($pro_id, $data1);
					$qty = $total_rest_stock - $qty;
					$data['rest_stock'] = $qty;
					$user_data = $cashinvoice->updateStock($id, $data);
					if($batch_no=="")
						$batch_no = $product['batch_no'];
					else
						$batch_no = ",".$product['batch_no'];
					break;
				}
			}
			else
			{
				$qty = $qty/$product_detail[0]['quantity'];
			 	if($total_rest_stock<$qty)
				{
					$total_stock = $product_detail[0]['quantity_in_stock'] -$total_rest_stock ;
			 		$data1['quantity_in_stock'] = $total_stock;
			 		$user_data = $cashinvoice->updateproduct($pro_id, $data1);
					$qty = $qty - $total_rest_stock;	
					$data['rest_stock'] = 0;
					$user_data = $cashinvoice->updateStock($id, $data);	
					$batch_no = $product['batch_no'];
				}
				else if($total_rest_stock==$qty){
					$total_stock = $product_detail[0]['quantity_in_stock'] - $qty ;
			 		$data1['quantity_in_stock'] = $total_stock;
			 		$user_data = $cashinvoice->updateproduct($pro_id, $data1);
					$qty = $qty - $total_rest_stock;
					$data['rest_stock'] = 0;
					$user_data = $cashinvoice->updateStock($id, $data);
					if($batch_no=="")
						$batch_no = $product['batch_no'];
					else
						$batch_no = ",".$product['batch_no'];
					break;
				}	
				else
				{
					$total_stock = $product_detail[0]['quantity_in_stock'] - $qty ;
			 		$data1['quantity_in_stock'] = $total_stock;
			 		$user_data = $cashinvoice->updateproduct($pro_id, $data1);
					$qty = $total_rest_stock - $qty;
					$data['rest_stock'] = $qty;
					$user_data = $cashinvoice->updateStock($id, $data);
					if($batch_no=="")
						$batch_no = $product['batch_no'];
					else
						$batch_no = ",".$product['batch_no'];
					break;
				}
			}
		}
}

echo $batch_no;
//echo $_REQUEST['product_uniform'];
//echo $_REQUEST['quantity'];
//echo $_REQUEST['product_id'];
//echo $_REQUEST['product_total'];
?>