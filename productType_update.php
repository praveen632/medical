<?php
include('include/includes.php');
$user = new Product_type();
$ids = $_POST['ids'];
$datas['product_uniforms'] = $_POST['id'];
$data['product_uniform'] = implode(',', $datas['product_uniforms']);
$data['name'] = $_POST['name'];
$data['created_at'] = date('y/m/d');
$data['updated_at'] = date('y/m/d');
$result = $user->productType_Update($ids, $data);
 if ($result) {
 	    echo '1';		                            
	} else {
		echo '0';		    	    
	} 

?>