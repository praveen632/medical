<?php
include('include/includes.php');
          $user = new Product();
          $data['name']=$_POST['name'];
		  $data['description']=$_POST['description'];
		  $data['company_id']=$_POST['ids'];
		  $data['product_id']=$_POST['idss'];
		  $data['product_uniform']=$_POST['id2'];
		  $data['quantity']=$_POST['quantity'];
		  $tax = $_POST['idT'];
		  $data['tax_id'] = implode(',', $tax);
		  $data['created_at'] = date('y/m/d');
		  $data['updated_at'] = date('y/m/d');
		  $result=$user->product_save($data);		   
		   if ($result) {
		   	    echo '1';		     	                        
		    } else {
		    	echo '0';		    	
		    }
	   
?>